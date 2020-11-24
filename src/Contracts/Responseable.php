<?php

declare(strict_types=1);

namespace Weskiller\Response\Contracts;

interface Responseable
{
    public function toResponse();
}