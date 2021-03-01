<?php

/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */

namespace Graycore\Cors\Test\Integration\Preflight;

use Magento\Framework\App\Response\Http;
use Magento\TestFramework\TestCase\AbstractController as ControllerTestCase;
use Zend\Http\Headers;

/**
 * Tests that the responses to REST API requests
 * properly respond with the CORS headers in the
 * default configuration
 * @author    Graycore <damien@graycore.io>
 * @copyright Graycore, LLC (https://www.graycore.io/)
 * @license   MIT https://github.com/graycoreio/magento2-cors/license
 * @link      https://github.com/graycoreio/magento2-cors
 */
class WebApiResponseTest extends ControllerTestCase
{
    const ENDPOINT = '/rest/default/V1/directory/currency';

    public function getResponse()
    {
        if (!$this->_response) {
            $this->_response = $this->_objectManager->get(\Magento\Framework\Webapi\Rest\Response::class);
        }
        return $this->_response;
    }

    private function dispatchToRestApi()
    {
        ob_start();
        $this->dispatch(self::ENDPOINT);
        $this->getResponse()->sendResponse();
        ob_end_clean();
    }

    private function dispatchToRestApiWithOrigin(string $origin)
    {
        $headers = new Headers();
        $headers->addHeaderLine('Origin: ' . $origin);
        $headers->addHeaderLine('Content-Type: application/json');
        $this->getRequest()->setMethod('OPTIONS')->setHeaders($headers);
        ob_start();
        $this->dispatch(self::ENDPOINT);
        $this->getResponse()->sendResponse();
        ob_end_clean();
    }

    public function testItDoesNotAddAnyCrossOriginHeadersOutOfTheBox()
    {
        $this->dispatchToRestApiWithOrigin("https://www.example.com");

        /** @var Http $response */
        $response = $this->getResponse();
        $this->assertFalse($response->getHeader('Access-Control-Allow-Origin'));
        $this->assertFalse($response->getHeader('Access-Control-Max-Age'));
    }

    /**
     * @magentoConfigFixture default/web/api_rest/cors_allowed_origins https://www.example.com
     */
    public function testItdoesNotAddAnyCrossOriginHeadersToATypicalRequest()
    {
        $this->dispatchToRestApi();

        /** @var Http $response */
        $response = $this->getResponse();
        $this->assertFalse($response->getHeader('Access-Control-Allow-Origin'));
    }

    /**
     * @magentoConfigFixture default/web/api_rest/cors_allowed_origins https://www.example.com
     */
    public function testTheWebApiPreflightResponseContainsCrossOriginHeaders()
    {
        $this->dispatchToRestApiWithOrigin("https://www.example.com");

        /** @var Http $response */
        $response = $this->getResponse();
        $this->assertNotFalse($response->getHeader('Access-Control-Allow-Origin'));
        $this->assertNotFalse($response->getHeader('Access-Control-Max-Age'));
        $this->assertSame(200, $response->getHttpResponseCode());
        $this->assertEquals("", $response->getBody());
    }
}
