<?php
/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */
namespace Graycore\Cors\Response\HeaderProvider;

use Graycore\Cors\Configuration\CorsConfigurationInterface;
use Graycore\Cors\Validator\CorsValidatorInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Request\Http;
use Magento\Framework\App\Response\HeaderProvider\AbstractHeaderProvider;
use Magento\Framework\App\Response\HeaderProvider\HeaderProviderInterface;

/**
 * CorsAllowOriginHeaderProvider is responsible for adding the header
 * Access-Control-Allow-Origin to a response.
 * @copyright Graycore, LLC (https://www.graycore.io/)
 * @license   MIT https://github.com/graycoreio/magento2-cors/license
 * @link      https://github.com/graycoreio/magento2-cors
 */
class CorsAllowOriginHeaderProvider extends AbstractHeaderProvider implements HeaderProviderInterface
{
    /**
     * @var string
     */
    protected $headerName = 'Access-Control-Allow-Origin';

    /**
     * @var string
     */
    protected $headerValue = '';

    /** @var CorsValidatorInterface */
    protected $validator;

    /** @var CorsConfigurationInterface */
    protected $configuration;

    /** @var Http */
    protected $request;

    /**
     * CorsAllowMethodsHeaderProvider constructor.
     *
     * @param CorsValidatorInterface $validator
     * @param CorsConfigurationInterface $configuration
     * @param RequestInterface $request
     */
    public function __construct(
        CorsValidatorInterface $validator,
        CorsConfigurationInterface $configuration,
        RequestInterface $request
    ) {
        $this->validator = $validator;
        $this->configuration = $configuration;
        $this->request = $request;
    }

    /**
     * Check if allowed origin is wildcard.
     *
     * @return bool
     */
    private function allowedOriginIsWildcard()
    {
        return in_array('*', $this->configuration->getAllowedOrigins());
    }

    /**
     * Determine if the header can be applied.
     *
     * @return bool
     */
    public function canApply()
    {
        return $this->validator->originIsValid() && $this->getValue();
    }

    /**
     * Get the header value.
     *
     * @return string
     */
    public function getValue()
    {
        if ($this->configuration->getAllowCredentials() && $this->allowedOriginIsWildcard()) {
            return $this->request->getHeader('Origin');
        }

        return $this->allowedOriginIsWildcard() ? '*' : $this->request->getHeader('Origin');
    }
}
