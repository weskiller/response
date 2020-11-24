<?php

declare(strict_types=1);

namespace Weskiller\Response\Traits;


use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Traits\Macroable;
use Weskiller\Support\Collection;
use Weskiller\Support\Exception\AttributeNotExistException;

/**
 * Class WithAttributes
 * @package Weskiller\Response\Traits
 * @mixin
 */
trait WithAttributes
{
    use Macroable;

    /** @var array */
    protected array $attributes = [];

    /**
     * @param string $name
     *
     * @return mixed
     * @throws Exception
     */
    public function __get(string $name)
    {
        return Arr::get($this->attributes,$name);
    }

    /**
     * @param string $name
     * @param $value
     */
    public function __set(string $name, $value)
    {
        Arr::get($this->attributes,$name,$value);
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function __isset(string $name)
    {
        return Arr::exists($this->attributes,$name);
    }

    /**
     * @param $name
     * @return void
     */
    public function __unset($name)
    {
        return Arr::first($this->attributes,$name);
    }


    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param string $name
     * @param $value
     * @return static
     */
    public function putAttr(string $name,$value) :self
    {
        $this->__set($name,$value);
        return $this;
    }

    /**
     * @param string $name
     * @return mixed
     * @throws AttributeNotExistException
     */
    public function getAttr(string $name)
    {
        return Collection::make($this->attributes)->pick($name);
    }

    /**
     * @param array $attributes
     * @return static
     */
    public function fillAttr(array $attributes) :self
    {
        foreach ($attributes as $name => $attribute) {
            $this->putAttr($name,$attribute);
        }
        return $this;
    }
}