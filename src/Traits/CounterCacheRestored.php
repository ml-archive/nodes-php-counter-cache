<?php
namespace Nodes\CounterCache\Traits;

/**
 * Trait CounterCacheRestored
 *
 * @trait
 * @package Nodes\CounterCache\Traits
 */
trait CounterCacheRestored
{
    /**
     * The "booting" of trait
     *
     * @author Morten Rugaard <moru@nodes.dk>
     *
     * @static
     * @return void
     */
    public static function bootCounterCacheRestored()
    {
        static::restored(function($model) {
            app('Nodes\CounterCache\CounterCache')->count($model);
        });
    }
}