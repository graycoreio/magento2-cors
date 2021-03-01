<?php
/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */
namespace Graycore\Cors\Response\HeaderProvider;

use Graycore\Cors\Configuration\CorsConfigurationInterface;
use Graycore\Cors\Validator\CorsValidatorInterface;
use Magento\Framework\App\Response\HeaderProvider\AbstractHeaderProvider;
use Magento\Framework\App\Response\HeaderProvider\HeaderProviderInterface;

/**
 * CorsExposeHeadersProvider is responsible for adding the header
 * Access-Control-Expose-Headers to a response.
 * @author    Graycore <damien@graycore.io>
 * @copyright Graycore, LLC (https://www.graycore.io/)
 * @license   MIT https://github.com/graycoreio/magento2-cors/license
 * @link      https://github.com/graycoreio/magento2-cors
 */
class CorsExposeHeadersProvider extends AbstractHeaderProvider implements HeaderProviderInterface
{
    /**
     * @var string
     */
    protected $headerName = 'Access-Control-Expose-Headers';

    /**
     * @var string
     */
    protected $headerValue = '';

    /** @var CorsConfigurationInterface */
    protected $configuration;

    /** @var CorsValidatorInterface */
    protected $validator;

    /**
     * CorsAllowMethodsHeaderProvider constructor.
     *
     * @param CorsConfigurationInterface $configuration
     * @param CorsValidatorInterface $validator
     **/
    public function __construct(CorsConfigurationInterface $configuration, CorsValidatorInterface $validator)
    {
        $this->configuration = $configuration;
        $this->validator = $validator;
    }

    public function getValue()
    {
        return $this->configuration->getExposedHeaders()
        ? implode(',', $this->configuration->getExposedHeaders())
        : $this->headerValue;
    }

    public function canApply(): bool
    {
        return $this->validator->isPreflightRequest() && $this->validator->originIsValid() && $this->getValue();
    }
}
