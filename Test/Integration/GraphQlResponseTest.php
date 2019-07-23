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
 * Tests that the responses to GraphQl API requests
 * properly respond with the CORS headers in the
 * default configuration
 * @category  PHP
 * @package   Graycore_Cors
 * @author    Graycore <damien@graycore.io>
 * @copyright Graycore, LLC (https://www.graycore.io/)
 * @license   MIT https://github.com/graycoreio/magento2-cors/license
 * @link      https://github.com/graycoreio/magento2-cors
 */
class GraphQlResponseTest extends ControllerTestCase
{
    private function dispatchToGraphQlApiWithOrigin(string $origin)
    {
        $headers = new Headers();
        $headers->addHeaderLine('Origin: ' . $origin);
        $headers->addHeaderLine('Content-Type: application/json');
        $this->getRequest()->setMethod('POST')->setHeaders($headers)
            ->setContent('{"query": "{products(search:\"Pierce\"){total_count}}"}');
        $this->dispatch('/graphql');
    }

    /**
     * @magentoConfigFixture default/web/graphql/cors_allowed_origins https://www.example.com
     */
    public function testTheGraphQlResponseContainsCrossOriginHeaders()
    {
        $this->dispatchToGraphQlApiWithOrigin("https://www.example.com");

        /** @var Http $response */
        $response = $this->getResponse();
        $this->assertNotFalse($response->getHeader('Access-Control-Allow-Origin'));
        $this->assertNotFalse($response->getHeader('Access-Control-Max-Age'));
    }

    /**
     * @magentoConfigFixture default/web/graphql/cors_allowed_origins https://www.example.com
     */
    public function testItdoesNotAddAnyCrossOriginHeadersToATypicalRequest()
    {
        $headers = new Headers();
        $headers->addHeaderLine('Origin: https://www.example.com');
        $this->dispatch('/');

        /** @var Http $response */
        $response = $this->getResponse();
        $this->assertFalse($response->getHeader('Access-Control-Allow-Origin'));
    }

    public function testItDoesNotAddAnyCrossOriginHeadersOutOfTheBox()
    {
        $this->dispatchToGraphQlApiWithOrigin("https://www.example.com");

        /** @var Http $response */
        $response = $this->getResponse();
        $this->assertFalse($response->getHeader('Access-Control-Allow-Origin'));
        $this->assertFalse($response->getHeader('Access-Control-Max-Age'));
    }

    public function testTheGraphQlApiWillRespondToAOptionsRequestWithA200Response()
    {
        $headers = new Headers();
        $headers->addHeaderLine('Origin: https://www.example.com');
        $headers->addHeaderLine('Content-Type: application/json');

        $this->getRequest()->setMethod('OPTIONS')->setHeaders($headers);
        $this->dispatch('/graphql');

        /** @var Http $response */
        $response = $this->getResponse();
        $this->assertSame(200, $response->getHttpResponseCode());
    }

    /**
     * @magentoConfigFixture default/web/graphql/cors_allowed_origins https://www.example.com
     */
    public function testTheGraphQlApiWillRespondToAOptionsRequestWithCorsHeadersOnTheResponse()
    {
        $headers = new Headers();
        $headers->addHeaderLine('Origin: https://www.example.com');
        $headers->addHeaderLine('Content-Type: application/json');

        $this->getRequest()->setMethod('OPTIONS')->setHeaders($headers);
        $this->dispatch('/graphql');

        /** @var Http $response */
        $response = $this->getResponse();
        $this->assertNotFalse($response->getHeader('Access-Control-Allow-Origin'));
        $this->assertNotFalse($response->getHeader('Access-Control-Max-Age'));
    }
}
