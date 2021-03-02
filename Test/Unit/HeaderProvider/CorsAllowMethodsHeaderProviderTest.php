<?php
/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */
namespace Graycore\Cors\Test\Unit\HeaderProvider;

use Graycore\Cors\Configuration\CorsConfigurationInterface;
use Graycore\Cors\Response\HeaderProvider\CorsAllowMethodsHeaderProvider;
use Graycore\Cors\Validator\CorsValidatorInterface;

/**
 * Tests that the CORS AllowMethods header
 * is properly applied to a response
 * @author    Graycore <damien@graycore.io>
 * @copyright Graycore, LLC (https://www.graycore.io/)
 * @license   MIT https://github.com/graycoreio/magento2-cors/license
 * @link      https://github.com/graycoreio/magento2-cors
 */
class CorsAllowMethodsHeaderProviderTest extends \PHPUnit\Framework\TestCase
{
    /** Access-Control-Allow-Methods Header name */
    const HEADER_NAME = 'Access-Control-Allow-Methods';

    /**
     * Access-Control-Allow-Methods Header value
     */
    const HEADER_VALUE = 'GET,POST,OPTIONS';

    /**
     * @var CorsAllowMethodsHeaderProvider
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

    protected function setUp(): void
    {
        $this->corsValidatorMock = $this->createMock(CorsValidatorInterface::class);
        $this->corsConfigurationMock = $this->createMock(CorsConfigurationInterface::class);
        $this->provider = new CorsAllowMethodsHeaderProvider($this->corsConfigurationMock, $this->corsValidatorMock);
    }

    public function testGetName()
    {
        $this->assertEquals($this::HEADER_NAME, $this->provider->getName(), 'Wrong header name');
    }

    public function testGetDefaultHeaderValue()
    {
        $this->assertEquals($this::HEADER_VALUE, $this->provider->getValue(), 'Wrong default header value');
    }

    public function testGetValueWillReturnTheDefaultValueIfTheConfigurationIsEmpty()
    {
        $stubMethods = [];
        $this->corsConfigurationMock->method('getAllowedMethods')->willReturn($stubMethods);
        $this->assertEquals('GET,POST,OPTIONS', $this->provider->getValue());
    }

    public function testItUsesTheValueDefinedByScope()
    {
        $stubMethods = ['GET'];
        $this->corsConfigurationMock->method('getAllowedMethods')->willReturn($stubMethods);
        $this->assertEquals('GET', $this->provider->getValue());
    }

    public function testItWillReturnACommaSeparatedListOfHeadersIfThereAreMultipleHeadersConfigured()
    {
        $stubMethods = ['GET', 'POST', 'OPTIONS'];
        $this->corsConfigurationMock->method('getAllowedMethods')->willReturn($stubMethods);
        $this->assertEquals('GET,POST,OPTIONS', $this->provider->getValue());
    }

    /**
     * @dataProvider canApplyDataProvider
     */
    public function testCanApply($methods, $originResult, $isPreflightRequest, $expected)
    {
        $this->corsConfigurationMock->method('getAllowedMethods')->willReturn($methods);
        $this->corsValidatorMock->method('originIsValid')->willReturn($originResult);
        $this->corsValidatorMock->method('isPreflightRequest')->willReturn($isPreflightRequest);
        $this->assertEquals($expected, $this->provider->canApply(), 'Incorrect canApply result');
    }

    public function canApplyDataProvider()
    {
        return [
            'invalid origin, cors request' => [
                ['GET', 'POST', 'OPTIONS'],
                false,
                false,
                false,
            ],
            'invalid origin, preflight request' => [
                ['GET', 'POST', 'OPTIONS'],
                false,
                true,
                false,
            ],
            'valid origin, cors request, without configured methods' => [
                [],
                true,
                false,
                false,
            ],
            'valid origin, preflight request, without configured methods' => [
                [],
                true,
                true,
                true,
            ],
            'valid origin, cors request, with configured methods' => [
                ['GET', 'POST', 'OPTIONS'],
                true,
                false,
                false,
            ],
            'valid origin, preflight request, with configured methods' => [
                ['GET', 'POST', 'OPTIONS'],
                true,
                true,
                true,
            ],
        ];
    }
}
