<?php

declare(strict_types=1);

namespace Weskiller\Response\Traits;


use Illuminate\Support\Arr;

/**
 * Class WithAttributes
 * @package Weskiller\Response\Traits
 * @mixin
 */
abstract class WithAttributes
{
    /** @var array */
    protected array $attributes = [];

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function __get(string $name)
    {
        return Arr::get($this->attributes, $name);
    }

    /**
     * @param string $name
     * @param $data
     *
     * @return WithAttributes
     */
    public function __set(string $name, $data)
    {
        Arr::set($this->attributes, $name, $data);
        return $this;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function __isset(string $name)
    {
        return Arr::exists($this->attributes, $name);
    }

    /**
     * @param $names
     */
    public function __unset($names)
    {
        Arr::forget($this->attributes, $names);
    }


    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }
}