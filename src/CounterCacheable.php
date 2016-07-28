<?php

namespace Nodes\CounterCache;

/**
 * Interface CounterCacheable.
 *
 * @interface
 */
interface CounterCacheable
{
    /**
     * Retrieve array of counter caches.
     *
     * @author Morten Rugaard <moru@nodes.dk>
     *
     * @return array
     */
    public function counterCaches();
}
