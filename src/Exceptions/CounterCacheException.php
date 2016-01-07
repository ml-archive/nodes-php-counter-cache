<?php
namespace Nodes\CounterCache\Exceptions;

use Nodes\Exceptions\Exception as NodesException;

/**
 * Class CounterCacheException
 *
 * @package Nodes\CounterCache\Exceptions
 */
class CounterCacheException extends NodesException
{
    /**
     * CounterCacheException constructor
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
    public function __construct($message = 'Counter cache failed', $code = 500, array $headers = [], $report = true, $severity = 'error')
    {
        parent::__construct($message, $code, $headers, $report, $severity);
    }
}