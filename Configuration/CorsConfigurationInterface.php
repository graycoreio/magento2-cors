<?php
/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */
namespace Graycore\Cors\Configuration;

/**
 * CorsConfigurationInterface is a generic interface
 * that describes what types of configuration one would need to
 * implement CORS from a the "Resource" side.
 * @copyright Graycore, LLC (https://www.graycore.io/)
 * @license   MIT https://github.com/graycoreio/magento2-cors/license
 * @link      https://github.com/graycoreio/magento2-cors
 */
interface CorsConfigurationInterface
{
    /**
     * Get the list of allowed origins.
     *
     * @return string[]
     */
    public function getAllowedOrigins(): array;

    /**
     * Get the list of allowed headers.
     *
     * @return string[]
     */
    public function getAllowedHeaders(): array;

    /**
     * Get the list of allowed methods.
     *
     * @return string[]
     */
    public function getAllowedMethods(): array;

    /**
     * Get the max age value.
     *
     * @return string|null
     */
    public function getMaxAge(): ?string;

    /**
     * Get whether credentials are allowed.
     *
     * @return bool
     */
    public function getAllowCredentials(): bool;

    /**
     * Get the list of exposed headers.
     *
     * @return string[]
     */
    public function getExposedHeaders(): array;
}
