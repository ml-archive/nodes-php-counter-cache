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
     * @param  string      $message
     * @param  integer     $statusCode
     * @param  string|null $statusMessage
     * @param  array       $headers
     * @param  boolean     $report
     */
    public function __construct($message = 'Counter cache failed', $statusCode = 500, $statusMessage = 'Counter cache failed', array $headers = [], $report = true)
    {
        parent::__construct($message, $statusCode, $statusMessage, $headers, $report);
    }
}