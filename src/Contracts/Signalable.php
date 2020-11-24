<?php


namespace Weskiller\Response\Contracts;


interface Signalable
{
    public function getCode();

    public function getMessage();
}