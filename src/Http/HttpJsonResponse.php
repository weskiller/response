<?php

declare(strict_types=1);

namespace Weskiller\Response\Http;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

abstract class HttpJsonResponse
    extends HttpResponse
    implements Arrayable, Jsonable
{
}
