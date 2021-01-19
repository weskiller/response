<?php

declare(strict_types=1);

namespace Weskiller\Response;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Arr;
use Stringable;
use Throwable;
use Weskiller\Response\Contracts\PayloadInterface;
use Weskiller\Response\Contracts\Signalable;
use Weskiller\Response\Exception\ThrowablePayload;
use Weskiller\Support\Collection;
use Weskiller\Support\Json\Translator;

class Payload implements Stringable, Arrayable, Jsonable,PayloadInterface
{
    /** @var Signalable */
    public Signalable $signal;

    /** @var array|null */
    public ?array $contents = null;

    public function __construct(Signalable $signal, ?array $contents = null)
    {
        $this->signal = $signal;
        $this->contents = $contents;
    }

    /**
     * @param Throwable|null $previous
     *
     * @param array|null $backtrace
     *
     * @return ThrowablePayload
     */
    public function toThrowable(
        Throwable $previous = null,
        array $backtrace = null
    ): ThrowablePayload {
        return new ThrowablePayload(
            $this,
            $backtrace ?? debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT),
            $previous
        );
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
    public function toJson($options = 0) :string
    {
        return Translator::encode($this->toArray());
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return Collection::make($this->contents)->toArray();
    }

    /**
     * @param $payloads
     *
     * @return static
     */
    public function fill($payloads)
    {
        foreach ($payloads as $name => $payload) {
            $this->put($name, $payload);
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

    /**
     * @return array|null
     */
    public function getContents(): ?array
    {
        return $this->contents;
    }

    /**
     * @return Signalable
     */
    public function getSignal(): Signalable
    {
        return $this->signal;
    }
}