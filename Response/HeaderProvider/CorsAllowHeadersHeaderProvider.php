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
 * CorsAllowHeadersHeaderProvider is responsible for adding the header
 * Access-Control-Allow-Headers to a response.
 * @category  PHP
 * @package   Graycore_Cors
 * @author    Graycore <damien@graycore.io>
 * @copyright Graycore, LLC (https://www.graycore.io/)
 * @license   MIT https://github.com/graycoreio/magento2-cors/license
 * @link      https://github.com/graycoreio/magento2-cors
 */
class CorsAllowHeadersHeaderProvider extends AbstractHeaderProvider implements HeaderProviderInterface
{
    /**
     * @var string
     */
    protected $headerName = 'Access-Control-Allow-Headers';

    /**
     * @var string
     */
    protected $headerValue = '';

    /** @var CorsConfigurationInterface */
    protected $configuration;

    /** @var CorsValidatorInterface */
    protected $validator;

    /**
     * CorsAllowHeadersHeaderProvider constructor.
     *
     * @param CorsConfigurationInterface $configuration
     * @param CorsValidatorInterface $validator
     */
    public function __construct(CorsConfigurationInterface $configuration, CorsValidatorInterface $validator)
    {
        $this->configuration = $configuration;
        $this->validator = $validator;
    }

    public function getValue()
    {
        return $this->configuration->getAllowedHeaders()
        ? implode(',', $this->configuration->getAllowedHeaders())
        : $this->headerValue;
    }

    public function canApply()
    {
        return $this->validator->originIsValid() && $this->getValue();
    }
}
