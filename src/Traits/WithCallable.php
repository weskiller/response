<?php

declare(strict_types=1);

namespace Weskiller\Response\Traits;


use Illuminate\Support\Arr;

trait WithCallable
{
    protected array $callables = [];

    /**
     * @param string $name
     * @param callable $callable
     *
     * @return $this
     */
    public function register(string $name, callable $callable): self
    {
        Arr::set($this->callables, $name, $callable);
        return $this;
    }

    /**
     * @param string $name
     * @param mixed ...$args
     *
     * @return mixed
     */
    public function fire(string $name, ...$args)
    {
        return call_user_func(Arr::get($this->callables, $name), ...$args);
    }
}