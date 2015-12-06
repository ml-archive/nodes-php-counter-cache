<?php
namespace Nodes\CounterCache\Traits;

/**
 * Trait CounterCacheDeleted
 *
 * @trait
 * @package Nodes\CounterCache\Traits
 */
trait CounterCacheDeleted
{
    /**
     * The "booting" of trait
     *
     * @author Morten Rugaard <moru@nodes.dk>
     *
     * @static
     * @return void
     */
    public static function bootCounterCacheDeleted()
    {
        static::deleted(function($model) {
            app('Nodes\CounterCache\CounterCache')->count($model);
        });
    }
}