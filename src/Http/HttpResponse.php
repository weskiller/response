<?php

declare(strict_types=1);

namespace Weskiller\Response\Http;


use Weskiller\Response\Contracts\PayloadInterface;
use Weskiller\Response\Contracts\Responseable;

abstract class HttpResponse implements Responseable
{
    /** @var int */
    protected int $httpStatusCode;

    /** @var PayloadInterface */
    protected PayloadInterface $payload;

    public function __construct(int $httpStatusCode, PayloadInterface $payload)
    {
        $this->httpStatusCode = $httpStatusCode;
        $this->payload = $payload;
    }
}