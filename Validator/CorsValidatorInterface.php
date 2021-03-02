<?php

namespace Graycore\Cors\Validator;

/**
 * CorsValidator is responsible for validating that a request should
 * apply CORS headers to its response.
 */
interface CorsValidatorInterface
{

    /**
     * Determines whether or not the origin of a request is valid
     * and should have CORS headers applied.
     * @api
     * @return bool
     */
    public function originIsValid(): bool;

    /**
     * Determines whether or not the current request is a preflight request.
     * @api
     */
    public function isPreflightRequest(): bool;
}
