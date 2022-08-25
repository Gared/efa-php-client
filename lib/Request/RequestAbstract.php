<?php
declare(strict_types=1);

namespace Gared\EFA\Request;

abstract class RequestAbstract implements RequestInterface
{
    private const DEFAULT_PARAMS = [
        'outputFormat' => 'JSON',
        'stateless' => 1,
        'locationServerActive' => 1,
        'coordOutputFormat' => 'WGS84[DD.DDDDD]',
        'coordOutputFormatTail' => 5,
        'sessionID' => 0,
        'requestID' => 0,
        'mId' => 'efa_www',
    ];

    public function getDefaultParameters(): array
    {
        return self::DEFAULT_PARAMS;
    }
}