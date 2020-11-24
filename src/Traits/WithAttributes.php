<?php

declare(strict_types=1);

namespace Weskiller\Response\Traits;


use Illuminate\Support\Arr;
use Weskiller\Response\Exception\AttributeNotExistException;

abstract class WithAttributes
{
    /** @var array */
    protected array $attributes = [];

    /**
     * @param string $name
     *
     * @return mixed
     * @throws AttributeNotExistException
     */
    public function pick(string $name)
    {
        if (Arr::exists($this->attributes, $name)) {
            return Arr::get($this->attributes, $name);
        }
        throw new AttributeNotExistException(sprintf(
            'attribute %s::%s does not exist.', static::class, $name
        ));
    }

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
}