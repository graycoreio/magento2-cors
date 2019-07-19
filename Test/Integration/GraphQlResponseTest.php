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
    public function testTheGraphQlResponseContainsCrossOriginHeaders()
    {
        $headers = new Headers();
        $headers->addHeaderLine('Origin: https://www.example.com');
        $headers->addHeaderLine('Content-Type: application/json');
        $this->getRequest()->setMethod('POST')->setHeaders($headers)
            ->setContent('{"query": "{products(search:\"Pierce\"){total_count}}"}');
        $this->dispatch('/graphql');

        /** @var Http $response */
        $response = $this->getResponse();
        $this->assertNotEmpty($response->getHeader('Access-Control-Allow-Origin'));
        $this->assertNotEmpty($response->getHeader('Access-Control-Max-Age'));
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

    public function testTheGraphQlAPIWillRespondWithCorsHeadersOnAnOptionsResponse()
    {
        $headers = new Headers();
        $headers->addHeaderLine('Origin: https://www.example.com');
        $headers->addHeaderLine('Content-Type: application/json');

        $this->getRequest()->setMethod('OPTIONS')->setHeaders($headers);
        $this->dispatch('/graphql');

        /** @var Http $response */
        $response = $this->getResponse();
        $this->assertNotEmpty($response->getHeader('Access-Control-Allow-Origin'));
        $this->assertNotEmpty($response->getHeader('Access-Control-Max-Age'));
    }
}
