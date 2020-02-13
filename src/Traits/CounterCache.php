<?php

namespace Nodes\CounterCache\Traits;

/**
 * Trait CounterCache.
 *
 * @trait
 */
trait CounterCache
{
    use CounterCacheSaved;
    use CounterCacheDeleted;
    use CounterCacheRestored;
}
