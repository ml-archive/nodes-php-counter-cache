<?php

namespace Nodes\CounterCache\Exceptions;

use Nodes\Exceptions\Exception as NodesException;

/**
 * Class CounterCacheException.
 */
class CounterCacheException extends NodesException
{
    /**
     * CounterCacheException constructor.
     *
     * @author Morten Rugaard <moru@nodes.dk>
     *
     * @param string $message
     * @param int    $code
     * @param array  $headers
     * @param bool   $report
     * @param string $severity
     */
    public function __construct($message = 'Counter cache failed', $code = 500, array $headers = [], $report = true, $severity = 'error')
    {
        parent::__construct($message, $code, $headers, $report, $severity);
    }
}
