<?php
namespace Nodes\CounterCache\Traits;

/**
 * Trait CounterCacheCreated
 *
 * @trait
 * @package Nodes\CounterCache\Traits
 */
trait CounterCacheCreated
{
    /**
     * The "booting" of trait
     *
     * @author Morten Rugaard <moru@nodes.dk>
     *
     * @static
     * @return void
     */
    public static function bootCounterCacheCreated()
    {
        static::created(function($model) {
            app('Nodes\CounterCache\CounterCache')->count($model);
        });
    }
}