<?php

namespace App\GraphQL\Exceptions;

use Exception;
use GraphQL\Error\ClientAware;
use GraphQL\Error\Error;
use Illuminate\Http\JsonResponse;
use Nuwave\Lighthouse\Exceptions\RendersErrorsExtensions;

abstract class BaseException extends Exception implements ClientAware, RendersErrorsExtensions
{
    protected $code;
    protected $reason;
    protected $httpCode;

    public function __construct(array $code, string $message, int $httpCode = 500)
    {
        parent::__construct($message);

        $this->code = $code[0];
        $this->reason = $code[1];
        $this->httpCode = $httpCode;
    }

    public function isClientSafe(): bool
    {
        return true;
    }

    public function extensionsContent(): array
    {
        return [
            'reason' => $this->reason,
            'code' => $this->code,
        ];
    }

    public function intoGraphQLError(): Error
    {
        return new Error(
            $this->getMessage(),
            null,
            null,
            [],
            null,
            $this,
            $this->extensionsContent(),
        );
    }

    /**
     * Manually throws a spec-compliant response
     * This should only ever be used by middleware, where the GraphQL error handler has not yet been initialised
     */
    public function throw()
    {
        return new JsonResponse([
            'errors' => [[
                'message' => $this->message,
                'extensions' => array_merge(
                    $this->extensionsContent(),
                    ['category' => $this->getCategory()]
                ),
            ]],
        ], $this->httpCode);
    }
}
