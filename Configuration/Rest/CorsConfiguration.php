<?php

/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */

namespace Graycore\Cors\Configuration\Rest;

use Graycore\Cors\Configuration\ConfigurationCleaner;
use Graycore\Cors\Configuration\CorsConfigurationInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * CorsConfiguration is responsible for retrieving the Configuration
 * for the WebApi REST CORS settings from the Magento Configuration.
 * @copyright Graycore, LLC (https://www.graycore.io/)
 * @license   MIT https://github.com/graycoreio/magento2-cors/license
 * @link      https://github.com/graycoreio/magento2-cors
 */
class CorsConfiguration implements CorsConfigurationInterface
{
    public const XML_PATH_WEBAPI_REST_CORS_ORIGINS = 'web/api_rest/cors_allowed_origins';

    public const XML_PATH_WEBAPI_REST_CORS_METHODS = 'web/api_rest/cors_allowed_methods';

    public const XML_PATH_WEBAPI_REST_CORS_HEADERS = 'web/api_rest/cors_allowed_headers';

    public const XML_PATH_WEBAPI_REST_CORS_MAX_AGE = 'web/api_rest/cors_max_age';

    public const XML_PATH_WEBAPI_REST_CORS_EXPOSE_HEADERS = 'web/api_rest/cors_expose_headers';

    public const XML_PATH_REST_CORS_CREDENTIALS = 'web/api_rest/cors_allow_credentials';

    /** @var ConfigurationCleaner */
    private $cleaner;

    /** @var ScopeConfigInterface */
    private $scopeConfig;

    /**
     * CorsAllowHeadersHeaderProvider constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->cleaner = new ConfigurationCleaner();
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Takes the configuration for Cors Origins and parses it into an array of allowed origins.
     *
     * @return array
     */
    public function getAllowedOrigins(): array
    {
        return $this->cleaner->processDelimitedString(
            $this->scopeConfig->getValue(self::XML_PATH_WEBAPI_REST_CORS_ORIGINS)
        );
    }

    /**
     * Retrieves the allowed CORS headers from configuration.
     *
     * @return array
     */
    public function getAllowedHeaders(): array
    {
        return $this->cleaner->processDelimitedString(
            $this->scopeConfig->getValue(self::XML_PATH_WEBAPI_REST_CORS_HEADERS)
        );
    }

    /**
     * Get the allowed methods.
     *
     * @return string[]
     */
    public function getAllowedMethods(): array
    {
        return $this->cleaner->processDelimitedString(
            $this->scopeConfig->getValue(self::XML_PATH_WEBAPI_REST_CORS_METHODS)
        );
    }

    /**
     * Get the max age value.
     *
     * @return string
     */
    public function getMaxAge(): string
    {
        return $this->scopeConfig->getValue(self::XML_PATH_WEBAPI_REST_CORS_MAX_AGE);
    }

    /**
     * Get whether credentials are allowed.
     *
     * @return bool
     */
    public function getAllowCredentials(): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_REST_CORS_CREDENTIALS);
    }

    /**
     * Get the exposed headers.
     *
     * @return string[]
     */
    public function getExposedHeaders(): array
    {
        return $this->cleaner->processDelimitedString(
            $this->scopeConfig->getValue(self::XML_PATH_WEBAPI_REST_CORS_EXPOSE_HEADERS)
        );
    }
}
