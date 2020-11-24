<?php

declare(strict_types=1);

namespace Weskiller\Response\WebSocket;

use Illuminate\Contracts\Support\Arrayable;
use Stringable;
use Weskiller\Support\Json\Translator;

abstract class JsonWebsocketResponse extends WebSocketResponse implements
    Stringable, Arrayable
{
    /**
     * @return string
     * @throws
     */
    public function __toString(): string
    {
        return Translator::encode($this->toArray());
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->payload->toArray();
    }
}
