<?php

namespace Graycore\Cors\Validator;

use Graycore\Cors\Configuration\CorsConfigurationInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Request\Http as HttpRequest;

/**
 * CorsValidator is responsible for validating that a request should
 * apply CORS headers to its response.
 * @category  PHP
 * @package   Graycore_Cors
 * @author    Graycore <damien@graycore.io>
 * @copyright Graycore, LLC (https://www.graycore.io/)
 * @license   MIT https://github.com/graycoreio/magento2-cors/license
 * @link      https://github.com/graycoreio/magento2-cors
 */
class CorsValidator implements CorsValidatorInterface
{

    /** @var CorsConfigurationInterface */
    protected $configuration;

    /** @var HttpRequest */
    protected $request;

    /**
     * CorsAllowHeadersHeaderProvider constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(CorsConfigurationInterface $configuration, RequestInterface $request)
    {
        $this->configuration = $configuration;
        $this->request = $request;
    }

    /**
     * Determines whether or not the request origin
     * is one of the origins configured for the application.
     * @return bool
     */
    private function requestOriginExistsInConfiguration()
    {
        return in_array($this->request->getHeader('Origin'), $this->configuration->getAllowedOrigins());
    }

    /**
     * Determines whether or the configuration specifies that
     * all origins should be allowed.
     * @return bool
     */
    private function configurationIsWildcard(): bool
    {
        return in_array('*', $this->configuration->getAllowedOrigins());
    }

    /**
     * Determines whether or not the origin of a request is valid
     * and should have CORS headers applied.
     * @return bool
     */
    public function originIsValid(): bool
    {
        if ($this->request instanceof HttpRequest) {
            //Validate that we're working with something that cares about CORS
            if (!$this->request->getHeader('Origin')) {
                return false;
            }

            return $this->configurationIsWildcard() || $this->requestOriginExistsInConfiguration();
        }
        return false;
    }
}
