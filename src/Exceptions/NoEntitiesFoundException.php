<?php
namespace Nodes\CounterCache\Exceptions;

/**
 * Class NoEntitiesFoundException
 *
 * @package Nodes\CounterCache\Exceptions
 */
class NoEntitiesFoundException extends CounterCacheException
{
    /**
     * NoEntitiesFoundException constructor
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
    public function __construct($message = 'No entities found', $statusCode = 500, $statusMessage = 'Counter cache failed', array $headers = [], $report = true)
    {
        parent::__construct($message, $statusCode, $statusMessage, $headers, $report);
    }
}