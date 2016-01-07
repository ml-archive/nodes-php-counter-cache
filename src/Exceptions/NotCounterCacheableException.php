<?php
namespace Nodes\CounterCache\Exceptions;

/**
 * Class NotCounterCacheableException
 *
 * @package Nodes\CounterCache\Exceptions
 */
class NotCounterCacheableException extends CounterCacheException
{
    /**
     * NotCounterCacheableException constructor
     *
     * @author Morten Rugaard <moru@nodes.dk>
     *
     * @access public
     * @param  string   $message
     * @param  integer  $code
     * @param  array    $headers
     * @param  boolean  $report
     * @param  string   $severity
     */
    public function __construct($message = 'Model does not implement CounterCacheable', $code = 500, array $headers = [], $report = true, $severity = 'error')
    {
        parent::__construct($message, $code, $headers, $report, $severity);
    }
}