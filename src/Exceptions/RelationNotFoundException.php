<?php
namespace Nodes\CounterCache\Exceptions;

/**
 * Class RelationNotFoundException
 *
 * @package Nodes\CounterCache\Exceptions
 */
class RelationNotFoundException extends CounterCacheException
{
    /**
     * RelationNotFoundException constructor
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
    public function __construct($message = 'Relation not found on model', $code = 500, array $headers = [], $report = true, $severity = 'error')
    {
        parent::__construct($message, $code, $headers, $report, $severity);
    }
}