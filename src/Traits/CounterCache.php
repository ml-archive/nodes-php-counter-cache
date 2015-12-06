<?php
namespace Nodes\CounterCache\Traits;

/**
 * Trait CounterCache
 *
 * @trait
 * @package Nodes\CounterCache\Traits
 */
trait CounterCache
{
    use CounterCacheSaved,
        CounterCacheDeleted,
        CounterCacheRestored;
}