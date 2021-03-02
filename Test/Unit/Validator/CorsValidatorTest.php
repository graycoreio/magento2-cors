<?php

/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */

namespace Graycore\Cors\Test\Unit\Validator;

use Graycore\Cors\Configuration\CorsConfigurationInterface;
use Graycore\Cors\Validator\CorsValidator;
use Magento\Framework\App\Request\Http;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager as ObjectManagerHelper;

/**
 * Tests the request validation that verifies
 * that the CORS headers should be added to a request.
 * @author    Graycore <damien@graycore.io>
 * @copyright Graycore, LLC (https://www.graycore.io/)
 * @license   MIT https://github.com/graycoreio/magento2-cors/license
 * @link      https://github.com/graycoreio/magento2-cors
 */
class CorsValidatorTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var CorsValidator
     */
    protected $validator;

    /**
     * @var CorsConfigurationInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $configurationMock;

    /**
     * @var Http|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $requestMock;

    protected function setUp(): void
    {
        $this->configurationMock = $this->createMock(CorsConfigurationInterface::class);
        $this->requestMock = $this->createMock(Http::class);
        $this->validator = new CorsValidator($this->configurationMock, $this->requestMock);
    }

    /**
     * @dataProvider originIsValidDataProvider
     */
    public function testOriginIsValid($allowedOrigins, $requestOrigin, $expected)
    {
        $this->configurationMock->method('getAllowedOrigins')->willReturn($allowedOrigins);
        $this->requestMock->method('getHeader')->willReturn($requestOrigin);
        return $this->assertEquals($expected, $this->validator->originIsValid());
    }

    public function testInvalidOriginScheme()
    {
        $this->configurationMock->method('getAllowedOrigins')->willReturn(['*']);
        $this->requestMock->method('getHeader')->willThrowException(
            new \Zend\Uri\Exception\InvalidArgumentException
        );
        return $this->assertEquals(false, $this->validator->originIsValid());
    }

    public function originIsValidDataProvider()
    {
        return [
            'valid origin' => [
                ['https://www.example.com'],
                'https://www.example.com',
                true,
            ],
            'valid origin with multiple configured origins' => [
                ['https://www.example.com', 'https://www.myotherexample.com'],
                'https://www.example.com',
                true,
            ],
            'invalid origin with configured origins' => [
                ['https://www.example.com', 'https://www.myotherexample.com'],
                'https://www.amalicicousdomain.com',
                false,
            ],
            'valid origin domain with invalid origin protocol (http)' => [
                ['https://www.example.com'],
                'http://www.example.com',
                false,
            ],
            'valid origin domain with invalid origin protocol (https)' => [
                ['http://www.example.com'],
                'https://www.example.com',
                false,
            ],
            'invalid origin with no configured origins' => [
                [],
                'https://www.amalicicousdomain.com',
                false,
            ],
            'any origin with a wildcard configured' => [
                ['*'],
                'https://some.random.domain',
                true,
            ],
        ];
    }

    /**
     * @dataProvider preflightTestDataProvider
     */
    public function testIsPreflightRequest($allowedOrigins, $requestOrigin, $method, $result)
    {
        $this->configurationMock->method('getAllowedOrigins')->willReturn($allowedOrigins);
        $this->requestMock->method('getHeader')->willReturn($requestOrigin);
        $this->requestMock->method('getMethod')->willReturn($method);

        return $this->assertEquals($result, $this->validator->isPreflightRequest());
    }

    public function preflightTestDataProvider()
    {
        return [
            'valid origin as GET' => [
                ['https://www.example.com'],
                'https://www.example.com',
                'GET',
                false,
            ],
            'valid origin as OPTIONS' => [
                ['https://www.example.com', 'https://www.myotherexample.com'],
                'https://www.example.com',
                'OPTIONS',
                true,
            ],
            'invalid origin as GET' => [
                ['https://www.example.com'],
                'https://www.anotherdomain.com',
                'GET',
                false,
            ],
            'invalid origin as OPTIONS' => [
                ['https://www.example.com', 'https://www.myotherexample.com'],
                'https://www.anotherdomain.com',
                'OPTIONS',
                true,
            ],
        ];
    }
}
