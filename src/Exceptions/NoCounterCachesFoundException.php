<?php
namespace Nodes\CounterCache\Exceptions;

/**
 * Class NoCounterCachesFound
 *
 * @package Nodes\CounterCache\Exceptions
 */
class NoCounterCachesFound extends CounterCacheException
{
    /**
     * NoCounterCachesFound constructor
     *
     * @author Morten Rugaard <moru@nodes.dk>
     *
     * @access public
     * @param  string      $message
     * @param  integer     $statusCode
     * @param  string|null $statusMessage
     * @param  array       $headers
     * @param  boolean     $report
     */
    public function __construct($message = 'No counter caches found on model', $statusCode = 500, $statusMessage = 'Counter cache failed', array $headers = [], $report = true)
    {
        parent::__construct($message, $statusCode, $statusMessage, $headers, $report);
    }
}