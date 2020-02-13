<?php

namespace Nodes\CounterCache\Exceptions;

/**
 * Class NoEntitiesFoundException.
 */
class NoEntitiesFoundException extends CounterCacheException
{
    /**
     * NoEntitiesFoundException constructor.
     *
     * @author Morten Rugaard <moru@nodes.dk>
     *
     * @param string $message
     * @param int    $code
     * @param array  $headers
     * @param bool   $report
     * @param string $severity
     */
    public function __construct($message = 'No entities found', $code = 500, array $headers = [], $report = true, $severity = 'error')
    {
        parent::__construct($message, $code, $headers, $report, $severity);
    }
}
