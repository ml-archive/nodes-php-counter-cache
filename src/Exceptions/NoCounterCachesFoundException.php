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
     * @param  string    $message
     * @param  integer   $code
     * @param  array     $headers
     * @param  boolean   $report
     * @param  string    $severity
     */
    public function __construct($message = 'No counter caches found on model', $code = 500, array $headers = [], $report = true, $severity = 'error')
    {
        parent::__construct($message, $code, $headers, $report, $severity);
    }
}