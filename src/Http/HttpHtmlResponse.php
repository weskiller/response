<?php

declare(strict_types=1);

namespace Weskiller\Response\Http;


use Illuminate\Contracts\Support\Renderable;

abstract class HttpHtmlResponse extends HttpResponse implements Renderable
{
}