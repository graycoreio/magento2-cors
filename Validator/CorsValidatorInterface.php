<?php

namespace Graycore\Cors\Validator;

/**
 * CorsValidator is responsible for validating that a request should
 * apply CORS headers to its response.
 * @package Graycore\Cors\Validator
 */
interface CorsValidatorInterface
{


    /**
     * Determines whether or not the origin of a request is valid
     * and should have CORS headers applied.
     * @return bool
     */
    public function originIsValid(): bool;
}
