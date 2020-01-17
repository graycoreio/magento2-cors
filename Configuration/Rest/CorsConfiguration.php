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
 * @category  PHP
 * @package   Graycore_Cors
 * @author    Graycore <damien@graycore.io>
 * @copyright Graycore, LLC (https://www.graycore.io/)
 * @license   MIT https://github.com/graycoreio/magento2-cors/license
 * @link      https://github.com/graycoreio/magento2-cors
 */
class CorsConfiguration implements CorsConfigurationInterface
{
    const XML_PATH_WEBAPI_REST_CORS_ORIGINS = 'web/api_rest/cors_allowed_origins';

    const XML_PATH_WEBAPI_REST_CORS_METHODS = 'web/api_rest/cors_allowed_methods';

    const XML_PATH_WEBAPI_REST_CORS_HEADERS = 'web/api_rest/cors_allowed_headers';

    const XML_PATH_WEBAPI_REST_CORS_MAX_AGE = 'web/api_rest/cors_max_age';

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
     * Takes the configuration for Cors Origins
     * and parses it into an array of allowed origins
     * @return array
     */
    public function getAllowedOrigins(): array
    {
        return $this->cleaner->processDelimitedString(
            $this->scopeConfig->getValue(self::XML_PATH_WEBAPI_REST_CORS_ORIGINS)
        );
    }

    /**
     * Retrieves the allowed CORS headers from configuration
     * @return string;
     */
    public function getAllowedHeaders(): array
    {
        return $this->cleaner->processDelimitedString(
            $this->scopeConfig->getValue(self::XML_PATH_WEBAPI_REST_CORS_HEADERS)
        );
    }

    /**
     * @return string[];
     */
    public function getAllowedMethods(): array
    {
        return $this->cleaner->processDelimitedString(
            $this->scopeConfig->getValue(self::XML_PATH_WEBAPI_REST_CORS_METHODS)
        );
    }

    /**
     * @return string;
     */
    public function getMaxAge(): string
    {
        return $this->scopeConfig->getValue(self::XML_PATH_WEBAPI_REST_CORS_MAX_AGE);
    }
}
