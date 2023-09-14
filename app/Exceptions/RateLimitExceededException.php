<?php

namespace App\Exceptions;

use Exception;

class RateLimitExceededException extends Exception
{
    public function render($request)
{
    return 'Rate limit exceeded. Please try again later.';
}

}
