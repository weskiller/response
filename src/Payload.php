<?php

declare(strict_types=1);

namespace Weskiller\Response;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Arr;
use Stringable;
use Throwable;
use Weskiller\Response\Http\HttpJsonResponse;
use Weskiller\Response\WebSocket\WebSocketResponse;
use Weskiller\Support\Json\Translator;

abstract class Payload implements Stringable, Arrayable, Jsonable
{
    /** @var Signal */
    public Signal $signal;

    /** @var array|null */
    public ?array $contents = null;

    public function __construct(Signal $signal, ?array $contents = null)
    {
        $this->signal = $signal;
        $this->contents = $contents;
    }

    /**
     * @param Throwable|null $previous
     *
     * @return ThrowablePayload
     */
    public function toThrowable(Throwable $previous = null)
    {
        $backtrace = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT);
        return new ThrowablePayload($this, $backtrace, $previous);
    }

    /**
     * @return string
     * @throws
     */
    public function __toString(): string
    {
        return $this->toJson();
    }

    /**
     * @param int $options
     *
     * @return string
     * @throws
     */
    public function toJson($options = 0)
    {
        return Translator::encode($this->toArray());
    }

    /**
     * @return array
     */
    abstract public function toArray(): array;

    /**
     * @param int $httpStatusCode
     *
     * @return HttpJsonResponse
     */
    abstract public function toHttpJsonResponse(int $httpStatusCode
    ): HttpJsonResponse;

    /**
     * @return WebSocketResponse
     */
    abstract public function toWebsocketResponse(): WebSocketResponse;

    /**
     * @param $payloads
     *
     * @return static
     */
    public function fill($payloads)
    {
        foreach ($payloads as $name => $payload) {
            $this->put($name, $payloads);
        }
        return $this;
    }

    /**
     * @param string $name
     * @param $data
     *
     * @return static
     */
    public function put(string $name, $data)
    {
        Arr::set($this->contents, $name, $data);
        return $this;
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function content(string $name)
    {
        return Arr::get($this->contents, $name);
    }
}