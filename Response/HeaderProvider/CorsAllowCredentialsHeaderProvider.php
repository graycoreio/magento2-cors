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
 * CorsAllowCredentialsHeaderProvider is responsible for adding the header
 * Access-Control-Allow-Credentials to a response.
 * @author    Matthew O'Loughlin <matthew@aligent.com.au>
 * @copyright Graycore, LLC (https://www.graycore.io/)
 * @license   MIT https://github.com/graycoreio/magento2-cors/license
 * @link      https://github.com/graycoreio/magento2-cors
 */
class CorsAllowCredentialsHeaderProvider extends AbstractHeaderProvider implements HeaderProviderInterface
{
    /**
     * @var string
     */
    protected $headerName = 'Access-Control-Allow-Credentials';

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
        return "true";
    }

    public function canApply()
    {
        return $this->validator->originIsValid() && $this->configuration->getAllowCredentials();
    }
}
