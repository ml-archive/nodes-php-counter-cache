<?php

namespace Nodes\CounterCache;

use BadMethodCallException;
use Illuminate\Database\Eloquent\Model as IlluminateModel;
use Illuminate\Database\Eloquent\Relations\Relation as IlluminateRelation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Nodes\CounterCache\Exceptions\NoCounterCachesFoundException;
use Nodes\CounterCache\Exceptions\NoEntitiesFoundException;
use Nodes\CounterCache\Exceptions\NotCounterCacheableException;
use Nodes\CounterCache\Exceptions\RelationNotFoundException;

/**
 * Class CounterCache.
 */
class CounterCache
{
    /**
     * Perform counter caching on model.
     *
     * @author Morten Rugaard <moru@nodes.dk>
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @throws \Nodes\CounterCache\Exceptions\NoCounterCachesFoundException
     * @throws \Nodes\CounterCache\Exceptions\NotCounterCacheableException
     * @throws \Nodes\CounterCache\Exceptions\RelationNotFoundException
     *
     * @return bool
     */
    public function count(IlluminateModel $model)
    {
        // If model does not implement the CounterCacheable
        // interface, we'll jump ship and abort.
        if (!$model instanceof CounterCacheable) {
            Log::error(sprintf('[%s] Model [%s] does not implement CounterCacheable.', __CLASS__, get_class($model)));

            throw new NotCounterCacheableException(sprintf('Model [%s] does not implement CounterCacheable.', __CLASS__, get_class($model)));
        }

        // Retrieve array of available counter caches
        $counterCaches = (array) $model->counterCaches();

        // Validate counter caches
        if (empty($counterCaches)) {
            Log::error(sprintf('[%s] No counter caches found on model [%s].', __CLASS__, get_class($model)));

            throw new NoCounterCachesFoundException(sprintf('No counter caches found on model [%s].', __CLASS__, get_class($model)));
        }

        // Handle each available counter caches
        foreach ($counterCaches as $counterCacheColumnName => $relations) {
            // Since an available counter cache could be found
            // in multiple tables, we'll need to support multiple relations.
            foreach ((array) $relations as $relationName => $counterCacheConditions) {
                // Sometimes our counter cache might require additional conditions
                // which means, we need to support both scenarios
                $relationName = !is_array($counterCacheConditions) ? $counterCacheConditions : $relationName;

                // When we've figured out the name of our relation
                // we'll just make a quick validation, that it actually exists
                if (!method_exists($model, $relationName)) {
                    Log::error(sprintf('[%s] Relation [%s] was not found on model [%s]', __CLASS__, $relationName, get_class($model)));

                    throw new RelationNotFoundException(sprintf('Relation [%s] was not found on model [%s]', __CLASS__, $relationName, get_class($model)));
                }

                // Retrieve relation query builder
                $relation = $model->{$relationName}();

                try {
                    // Update the count value for counter cache column
                    $this->updateCount($model, $relation, $counterCacheConditions, $model->getAttribute($relation->getForeignKey()), $counterCacheColumnName);

                    // If our model's foreign key has been updated,
                    // we need to update the counter cache for the previous value as well
                    if (!is_null($model->getOriginal($relation->getForeignKey())) && $model->getOriginal($relation->getForeignKey()) != $model->getAttribute($relation->getForeignKey())) {
                        // Retrieve original foreign key
                        $originalForeignKey = $model->getOriginal($relation->getForeignKey());

                        // Re-instantiate model and fill it with original foreign key
                        $reModel = $model->newInstance([$relation->getForeignKey() => $originalForeignKey]);

                        // Update the count value for for counter cache column
                        $this->updateCount($reModel, $reModel->{$relationName}(), $counterCacheConditions,
                            $originalForeignKey, $counterCacheColumnName);
                    }
                } catch (BadMethodCallException $e) {
                    // Update the count value for counter cache column
                    $this->updateCount($model, $relation, $counterCacheConditions, $model->getAttribute($relation->getQualifiedForeignKeyName()), $counterCacheColumnName);

                    // If our model's foreign key has been updated,
                    // we need to update the counter cache for the previous value as well
                    if (!is_null($model->getOriginal($relation->getQualifiedForeignKeyName())) && $model->getOriginal($relation->getQualifiedForeignKeyName()) != $model->getAttribute($relation->getQualifiedForeignKeyName())) {
                        // Retrieve original foreign key
                        $originalForeignKey = $model->getOriginal($relation->getQualifiedForeignKeyName());

                        // Re-instantiate model and fill it with original foreign key
                        $reModel = $model->newInstance([$relation->getQualifiedForeignKeyName() => $originalForeignKey]);

                        // Update the count value for for counter cache column
                        $this->updateCount($reModel, $reModel->{$relationName}(), $counterCacheConditions,
                            $originalForeignKey, $counterCacheColumnName);
                    }
                }
            }
        }

        return true;
    }

    /**
     * Perform counter caching on all entities of model.
     *
     * @author Morten Rugaard <moru@nodes.dk>
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @throws \Nodes\CounterCache\Exceptions\NoEntitiesFoundException
     * @throws \Nodes\CounterCache\Exceptions\NoCounterCachesFound
     * @throws \Nodes\CounterCache\Exceptions\NotCounterCacheableException
     * @throws \Nodes\CounterCache\Exceptions\RelationNotFoundException
     *
     * @return bool
     */
    public function countAll(IlluminateModel $model)
    {
        // Retrieve all entities of model
        $entities = $model->get();

        // If no entities found, we'll log the error,
        // throw an exception and abort.
        if (!$entities->isEmpty()) {
            Log::error(sprintf('[%s] No entities found of model [%s]', __CLASS__, get_class($model)));

            throw new NoEntitiesFoundException(sprintf('No entities found of model [%s]', get_class($model)));
        }

        // Perform counter caching on each found entity
        foreach ($entities as $entry) {
            $this->count($entry);
        }

        return true;
    }

    /**
     * Update counter cache column.
     *
     * @author Morten Rugaard <moru@nodes.dk>
     *
     * @param \Illuminate\Database\Eloquent\Model              $model
     * @param \Illuminate\Database\Eloquent\Relations\Relation $relation
     * @param array|null                                       $counterCacheConditions
     * @param string                                           $foreignKey
     * @param string                                           $counterCacheColumnName
     *
     * @return bool
     */
    protected function updateCount(IlluminateModel $model, IlluminateRelation $relation, $counterCacheConditions, $foreignKey, $counterCacheColumnName)
    {
        // Retrieve table name of relation
        $relationTableName = $relation->getModel()->getTable();

        // Generate query builder for counting entries
        // on our model. Result will be used as value when
        // we're updating the counter cache column on the relation
        try {
            $countQuery = $model->newQuery()->select(DB::raw(sprintf('COUNT(%s.id)',
                $model->getTable())))->join(DB::raw(sprintf('(SELECT %s.%s FROM %s) as relation',
                $relationTableName, $relation->getOwnerKey(), $relationTableName)),
                $relation->getQualifiedForeignKey(), '=', sprintf('relation.%s',
                    $relation->getOwnerKey()))->where($relation->getQualifiedForeignKey(), '=',
                $this->prepareValue($foreignKey));
        } catch (BadMethodCallException $e) {
            $countQuery = $model->newQuery()->select(DB::raw(sprintf('COUNT(%s.id)',
                $model->getTable())))->join(DB::raw(sprintf('(SELECT %s.%s FROM %s) as relation',
                $relationTableName, $relation->getOwnerKeyName(), $relationTableName)),
                $relation->getQualifiedForeignKeyName(), '=', sprintf('relation.%s',
                    $relation->getOwnerKeyName()))->where($relation->getQualifiedForeignKeyName(), '=',
                $this->prepareValue($foreignKey));
        }
        // If our relation has additional conditions, we'll need
        // to add them to our query builder that counts the entries
        if (is_array($counterCacheConditions)) {
            foreach ($counterCacheConditions as $conditionType => $conditionParameters) {
                foreach ($conditionParameters as $parameters) {
                    call_user_func_array([$countQuery, $conditionType], $parameters);
                }
            }
        }

        // Retrieve countQuery SQL
        // and prepare for binding replacements
        $countQuerySql = str_replace(['%', '?'], ['%%', '%s'], $countQuery->toSql());

        // Fire the update query
        // to update counter cache column
        return (bool) $relation->getBaseQuery()->update([
            sprintf('%s.%s', $relationTableName, $counterCacheColumnName) => DB::raw(sprintf('(%s)', vsprintf($countQuerySql, $countQuery->getBindings()))),
        ]);
    }

    /**
     * Prepare value for SQL insertion.
     *
     * @author Morten Rugaard <moru@nodes.dk>
     *
     * @param string $value
     *
     * @return int|string
     */
    private function prepareValue($value)
    {
        return is_numeric($value) ? $value : sprintf('"%s"', $value);
    }
}
