<?php

declare(strict_types=1);

namespace Weskiller\Response\WebSocket;


use Weskiller\Response\Payload;
use Weskiller\Response\Responseable;

abstract class WebSocketResponse implements Responseable
{
    /** @var Payload */
    protected Payload $payload;

    public function __construct(Payload $payload)
    {
        $this->payload = $payload;
    }
}