<?php

declare(strict_types=1);

namespace Weskiller\Response\Traits;


use BadMethodCallException;
use Exception;
use Illuminate\Support\Traits\Macroable;
use Weskiller\Support\Collection;

/**
 * Class WithAttributes
 * @package Weskiller\Response\Traits
 * @mixin Collection
 */
trait WithAttributes
{
    use Macroable;

    /** @var Collection|null */
    protected ?Collection $attributes = null;

    /**
     * @param string $name
     *
     * @return mixed
     * @throws Exception
     */
    public function __get(string $name)
    {
        return $this->attributes->offsetGet($name);
    }

    /**
     * @param string $name
     * @param $data
     */
    public function __set(string $name, $data)
    {
        $this->attributes->offsetSet($name,$data);
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function __isset(string $name)
    {
        return $this->attributes->offsetExists($name);
    }

    /**
     * @param $name
     * @return void
     */
    public function __unset($name)
    {
        $this->attributes->offsetUnset($name);
    }


    /**
     * @return Collection
     */
    public function getAttributes(): Collection
    {
        return $this->attributes;
    }

    /**
     * @param $method
     * @param $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if(!method_exists($this->attributes,$method)) {
            throw new BadMethodCallException(sprintf(
                'Method %s::%s does not exist.', static::class, $method
            ));
        }
        return $this->attributes->{$method}(...$parameters);
    }
}