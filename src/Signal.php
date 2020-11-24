<?php

declare(strict_types=1);

namespace Weskiller\Response;

class Signal
{
    /** @var int|string */
    protected $code;

    /** @var string | null */
    protected ?string $message = null;

    /**
     * Signal constructor.
     *
     * @param int|string $code
     * @param $message
     */
    public function __construct($code, ?string $message = null)
    {
        $this->code = $code;
        $this->message = $message;
    }

    /**
     * @return int|string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }
}