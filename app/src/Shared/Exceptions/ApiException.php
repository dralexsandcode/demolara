<?php

namespace App\src\Shared\Exceptions;

use App\src\Shared\Traits\HttpResponsesTrait;
use Exception;
use Illuminate\Http\JsonResponse;

class ApiException extends Exception
{
    use HttpResponsesTrait;

    public function render(): JsonResponse
    {
        return $this->httpResponseError(
            $this->getMessage(),
            $this->getCode()
        );
    }

}
