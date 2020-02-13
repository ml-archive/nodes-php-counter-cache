<?php

namespace Nodes\CounterCache\Traits;

/**
 * Trait CounterCacheSaved.
 *
 * @trait
 */
trait CounterCacheSaved
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
    public static function bootCounterCacheSaved()
    {
        static::saved(function ($model) {
            app('Nodes\CounterCache\CounterCache')->count($model);
        });
    }
}
