<?php
/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */
namespace Graycore\Cors\Test\Unit\HeaderProvider;

use Graycore\Cors\Configuration\CorsConfigurationInterface;
use Graycore\Cors\Response\HeaderProvider\CorsAllowOriginHeaderProvider;
use Magento\Framework\App\Request\Http;
use Graycore\Cors\Validator\CorsValidatorInterface;

/**
 * Tests that the CORS AllowOrigin header
 * is properly applied to a response
 * @category  PHP
 * @package   Graycore_Cors
 * @author    Graycore <damien@graycore.io>
 * @copyright Graycore, LLC (https://www.graycore.io/)
 * @license   MIT https://github.com/graycoreio/magento2-cors/license
 * @link      https://github.com/graycoreio/magento2-cors
 */
class CorsAllowOriginHeaderProviderTest extends \PHPUnit\Framework\TestCase
{
    /** Access-Control-Allow-Origin Header name */
    const HEADER_NAME = 'Access-Control-Allow-Origin';

    /**
     * Access-Control-Allow-Origin value
     */
    const HEADER_VALUE = '';

    /**
     * @var CorsAllowOriginHeaderProvider
     */
    protected $provider;

    /**
     * @var CorsValidatorInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $corsValidatorMock;

    /**
     * @var CorsConfigurationInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $corsConfigurationMock;

    /**
     * @var Http|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $requestMock;

    protected function setUp()
    {
        $this->corsValidatorMock = $this->createMock(CorsValidatorInterface::class);
        $this->requestMock = $this->createMock(Http::class);
        $this->corsConfigurationMock = $this->createMock(CorsConfigurationInterface::class);

        $this->provider = new CorsAllowOriginHeaderProvider(
            $this->corsValidatorMock,
            $this->corsConfigurationMock,
            $this->requestMock
        );
    }

    public function testGetName()
    {
        $this->assertEquals($this::HEADER_NAME, $this->provider->getName(), 'Wrong header name');
    }

    public function testGetDefaultHeaderValue()
    {
        $this->assertEquals($this::HEADER_VALUE, $this->provider->getValue(), 'Wrong default header value');
    }

    /**
     * @dataProvider getValueDataProvider
     */
    public function testGetValue($allowedOrigins, $originHeader, $expected)
    {
        $this->corsConfigurationMock->method('getAllowedOrigins')->willReturn($allowedOrigins);
        $this->requestMock->method('getHeader')->willReturn($originHeader);
        $this->assertEquals($expected, $this->provider->getValue());
    }

    public function getValueDataProvider()
    {
        return [
            'valid origin' => [
                ['https://www.google.com', 'https://www.example.com'],
                'https://www.example.com',
                'https://www.example.com',
            ],
            'wildcard origin' => [
                ['*'],
                'https://www.example.com',
                '*',
            ],
        ];
    }

    /**
     * @dataProvider canApplyDataProvider
     */
    public function testCanApply($originIsValid, $requestOrigin, $expected)
    {
        $this->requestMock->method('getHeader')->willReturn($requestOrigin);
        $this->corsValidatorMock->method('originIsValid')->willReturn($originIsValid);

        $this->assertEquals($expected, $this->provider->canApply(), 'Incorrect canApply result');
    }

    public function canApplyDataProvider()
    {
        return [
            'invalid origin' => [
                false,
                'https://www.someorigin.com',
                false,
            ],
            'valid origin' => [
                true,
                'https://www.someorigin.com',
                true,
            ],
        ];
    }
}
