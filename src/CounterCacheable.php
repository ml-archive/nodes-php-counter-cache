<?php
namespace Nodes\CounterCache;

/**
 * Interface CounterCacheable
 *
 * @interface
 * @package Nodes\CounterCache
 */
interface CounterCacheable
{
    /**
     * Retrieve array of counter caches
     *
     * @author Morten Rugaard <moru@nodes.dk>
     *
     * @access public
     * @return array
     */
    public function counterCaches();
}