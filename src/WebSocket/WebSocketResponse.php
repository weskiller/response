<?php

declare(strict_types=1);

namespace Weskiller\Response\WebSocket;


use Weskiller\Response\Contracts\PayloadInterface;
use Weskiller\Response\Contracts\Responseable;

abstract class WebSocketResponse implements Responseable
{
    /** @var PayloadInterface */
    protected PayloadInterface $payload;

    public function __construct(PayloadInterface $payload)
    {
        $this->payload = $payload;
    }
}