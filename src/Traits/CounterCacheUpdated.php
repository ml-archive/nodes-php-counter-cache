<?php

namespace Nodes\CounterCache\Traits;

/**
 * Trait CounterCacheUpdated.
 *
 * @trait
 */
trait CounterCacheUpdated
{
    /**
     * The "booting" of trait.
     *
     * @author Morten Rugaard <moru@nodes.dk>
     *
     * @static
     *
     * @return void
     */
    public static function bootCounterCacheUpdated()
    {
        static::updated(function ($model) {
            app('Nodes\CounterCache\CounterCache')->count($model);
        });
    }
}
