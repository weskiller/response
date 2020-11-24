<?php


namespace Weskiller\Response\Contracts;


interface PayloadInterface
{
    public function getSignal(): Signalable;
    public function getContents();
}