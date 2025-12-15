<?php
/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */
namespace Graycore\Cors\Response;

use Magento\Framework\App\Response\HeaderProvider\HeaderProviderInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Phrase;

/**
 * CorsAllowHeadersHeaderProvider is responsible for adding the header
 * Access-Control-Allow-Headers to a response.
 * @copyright Graycore, LLC (https://www.graycore.io/)
 * @license   MIT https://github.com/graycoreio/magento2-cors/license
 * @link      https://github.com/graycoreio/magento2-cors
 */
class HeaderManager
{
    /**
     * @var HeaderProviderInterface[]
     */
    private $headerProviders;

    /**
     * @param HeaderProviderInterface[] $headerProviderList
     * @throws LocalizedException In case one of the header providers is invalid
     */
    public function __construct($headerProviderList)
    {
        foreach ($headerProviderList as $header) {
            if (!($header instanceof HeaderProviderInterface)) {
                throw new LocalizedException(new Phrase('The header provider is invalid. Verify and try again.'));
            }
        }
        $this->headerProviders = $headerProviderList;
    }

    /**
     * Apply CORS headers to the response.
     *
     * @param \Magento\Framework\App\Response\HttpInterface $response
     * @return \Magento\Framework\App\Response\HttpInterface
     */
    public function applyHeaders(\Magento\Framework\App\Response\HttpInterface $response)
    {
        foreach ($this->headerProviders as $provider) {
            if ($provider->canApply()) {
                $response->setHeader($provider->getName(), $provider->getValue());
            }
        }
        return $response;
    }

    /**
     * Apply CORS headers before sending response.
     *
     * @param \Magento\Framework\App\Response\HttpInterface $subject
     * @return void
     * @codeCoverageIgnore
     */
    public function beforeSendResponse(\Magento\Framework\App\Response\HttpInterface $subject)
    {
        $this->applyHeaders($subject);
    }
}
