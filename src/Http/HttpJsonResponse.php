<?php

declare(strict_types=1);

namespace Weskiller\Response\Http;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

abstract class HttpJsonResponse extends HttpResponse implements Arrayable,
                                                                Jsonable
{
    /**
     * @return string
     * @throws
     */
    public function __toString(): string
    {
        return (string) $this->payload;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->payload->toArray();
    }

    /**
     * @param int $options
     *
     * @return string
     */
    public function toJson($options = 0): string
    {
        return $this->payload->toJson($options);
    }
}
