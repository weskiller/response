<?php

declare(strict_types=1);

namespace Weskiller\Response\Http;


use Weskiller\Response\Payload;
use Weskiller\Response\Responseable;

abstract class HttpResponse implements Responseable
{
    /** @var int */
    protected int $httpStatusCode;

    /** @var Payload */
    protected Payload $payload;

    public function __construct(int $httpStatusCode, Payload $payload)
    {
        $this->httpStatusCode = $httpStatusCode;
        $this->payload = $payload;
    }
}