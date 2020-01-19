<?php
/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */
namespace Graycore\Cors\Test\Integration;

use Magento\Framework\App\Response\Http;
use Magento\TestFramework\TestCase\AbstractController as ControllerTestCase;
use Zend\Http\Headers;

/**
 * Tests that the responses to REST API requests
 * properly respond with the CORS headers in the
 * default configuration
 * @category  PHP
 * @package   Graycore_Cors
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

    private function dispatchToRestApi(){
        ob_start();
        $this->dispatch(self::ENDPOINT);
        ob_end_clean();
    }

    private function dispatchToRestApiWithOrigin(string $origin)
    {
        $headers = new Headers();
        $headers->addHeaderLine('Origin: ' . $origin);
        $headers->addHeaderLine('Content-Type: application/json');
        $this->getRequest()->setMethod('GET')->setHeaders($headers);
        ob_start();
        $this->dispatch(self::ENDPOINT);
        ob_end_clean();
    }

    /**
     * @magentoConfigFixture default/web/api_rest/cors_allowed_origins https://www.example.com
     */
    public function testTheRestApiResponseContainsCrossOriginHeaders()
    {
        $this->dispatchToRestApiWithOrigin("https://www.example.com");

        /** @var Http $response */
        $response = $this->getResponse();

        $this->assertNotFalse($response->getHeader('Access-Control-Allow-Origin'));
        $this->assertNotFalse($response->getHeader('Access-Control-Max-Age'));
    }

    /**
     * @magentoConfigFixture default/web/api_rest/cors_allowed_origins https://www.example.com
     */
    public function testItdoesNotAddAnyCrossOriginHeadersToATypicalRequest()
    {
        $headers = new Headers();
        $headers->addHeaderLine('Origin: https://www.example.com');
        $this->dispatchToRestApi();

        /** @var Http $response */
        $response = $this->getResponse();
        $this->assertFalse($response->getHeader('Access-Control-Allow-Origin'));
    }

    public function testItDoesNotAddAnyCrossOriginHeadersOutOfTheBox()
    {
        $this->dispatchToRestApiWithOrigin("https://www.example.com");

        /** @var Http $response */
        $response = $this->getResponse();
        $this->assertFalse($response->getHeader('Access-Control-Allow-Origin'));
        $this->assertFalse($response->getHeader('Access-Control-Max-Age'));
    }

    public function testTheRestApiWillRespondToAOptionsRequestWithA200Response()
    {
        $headers = new Headers();
        $headers->addHeaderLine('Origin: https://www.example.com');
        $headers->addHeaderLine('Content-Type: application/json');

        $this->getRequest()->setMethod('OPTIONS')->setHeaders($headers);
        $this->dispatchToRestApi();

        /** @var Http $response */
        $response = $this->getResponse();
        $this->assertSame(200, $response->getHttpResponseCode());
    }

    /**
     * @group fit
     * @magentoConfigFixture default/web/api_rest/cors_allowed_origins https://www.example.com
     */
    public function testTheRestApiWillRespondToAOptionsRequestWithCorsHeadersOnTheResponse()
    {
        $headers = new Headers();
        $headers->addHeaderLine('Origin: https://www.example.com');
        $headers->addHeaderLine('Content-Type: application/json');

        $this->getRequest()->setMethod('POST');
        $this->dispatch(self::ENDPOINT);

        /** @var Http $response */
        $response = $this->getResponse();
        $this->assertNotFalse($response->getHeader('Access-Control-Allow-Origin'));
        $this->assertNotFalse($response->getHeader('Access-Control-Max-Age'));
    }
}
