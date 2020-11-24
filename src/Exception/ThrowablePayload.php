<?php

declare(strict_types=1);

namespace Weskiller\Response\Exception;

use Exception;
use Throwable;
use Weskiller\Response\Payload;

class ThrowablePayload extends Exception
{
    /** @var Payload */
    protected Payload $payload;

    /** @var array */
    protected array $backtrace;

    /** @var Throwable|null */
    protected ?Throwable $previous = null;

    public function __construct(
        Payload $payload,
        array $backtrace,
        Throwable $previous = null
    ) {
        $this->payload = $payload;
        $this->backtrace = $backtrace;
        parent::__construct((string) $this->payload->signal->getMessage(),
            $this->payload->signal->getCode(), $previous);
        $this->file = $this->throwAt()['file'];
        $this->line = $this->throwAt()['line'];
    }

    /**
     * @return array
     */
    public function throwAt(): array
    {
        return $this->backtrace[0];
    }
}