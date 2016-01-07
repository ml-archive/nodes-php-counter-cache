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
     * @param  string   $message
     * @param  integer  $code
     * @param  array    $headers
     * @param  boolean  $report
     * @param  string   $severity
     */
    public function __construct($message = 'No entities found', $code = 500, array $headers = [], $report = true, $severity = 'error')
    {
        parent::__construct($message, $code, $headers, $report, $severity);
    }
}