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
 * CorsVaryHeaderProvider is responsible for adding the header
 * Vary Header to a response.
 * @author    Graycore <damien@graycore.io>
 * @copyright Graycore, LLC (https://www.graycore.io/)
 * @license   MIT https://github.com/graycoreio/magento2-cors/license
 * @link      https://github.com/graycoreio/magento2-cors
 */
class CorsVaryHeaderProvider extends AbstractHeaderProvider implements HeaderProviderInterface
{
    /**
     * @var string
     */
    protected $headerName = 'Vary';

    /**
     * @var string
     */
    protected $headerValue = 'Origin';

    /** @var CorsValidatorInterface */
    protected $validator;

    /** @var Http */
    protected $request;

    /**
     * CorsAllowMethodsHeaderProvider constructor.
     *
     * @param CorsValidatorInterface $validator
     **/
    public function __construct(
        CorsValidatorInterface $validator,
        RequestInterface $request
    ) {
        $this->validator = $validator;
        $this->request = $request;
    }

    /**
     * We check to see if we can apply the header. Note that, for HTTP,
     *
     * ```
     * Vary: Accept-Encoding
     * Vary: Origin
     * ```
     *
     * is the same as
     *
     * ```
     * Vary: Accept-Encoding, Origin
     * ```
     *
     * So, we don't bother attempting to merge the two hears into a comma-separated list.
     */
    public function canApply(): bool
    {
        return $this->validator->originIsValid() && $this->request->getMethod() == "OPTIONS" && $this->getValue();
    }
}
