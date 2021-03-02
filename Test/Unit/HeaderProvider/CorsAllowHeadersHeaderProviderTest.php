<?php
/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */
namespace Graycore\Cors\Test\Unit\HeaderProvider;

use Graycore\Cors\Response\HeaderProvider\CorsAllowHeadersHeaderProvider;
use Graycore\Cors\Configuration\CorsConfigurationInterface;
use Graycore\Cors\Validator\CorsValidatorInterface;

/**
 * Tests that the CORS AllowHeader header
 * is properly applied to a response
 * @author    Graycore <damien@graycore.io>
 * @copyright Graycore, LLC (https://www.graycore.io/)
 * @license   MIT https://github.com/graycoreio/magento2-cors/license
 * @link      https://github.com/graycoreio/magento2-cors
 */
class CorsAllowHeadersHeaderProviderTest extends \PHPUnit\Framework\TestCase
{
    /** Access-Control-Allow-Headers Header name */
    const HEADER_NAME = 'Access-Control-Allow-Headers';

    /**
     * Access-Control-Allow-Headers Header value
     */
    const HEADER_VALUE = '';

    /**
     * @var CorsAllowHeadersHeaderProvider
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
        $this->provider = new CorsAllowHeadersHeaderProvider($this->corsConfigurationMock, $this->corsValidatorMock);
    }

    public function testGetName()
    {
        $this->assertEquals($this::HEADER_NAME, $this->provider->getName(), 'Wrong header name');
    }

    public function testGetDefaultHeaderValue()
    {
        $this->assertEquals($this::HEADER_VALUE, $this->provider->getValue(), 'Wrong default header value');
    }

    public function testGetValueWillReturnAnEmptyStringIfTheConfigurationIsEmpty()
    {
        $stubHeaders = [];
        $this->corsConfigurationMock->method('getAllowedHeaders')->willReturn($stubHeaders);
        $this->assertEquals('', $this->provider->getValue());
    }

    public function testItUsesTheValueDefinedByScope()
    {
        $stubHeaders = ['My-Custom-Header'];
        $this->corsConfigurationMock->method('getAllowedHeaders')->willReturn($stubHeaders);
        $this->assertEquals('My-Custom-Header', $this->provider->getValue());
    }

    public function testItWillReturnACommaSeparatedListOfHeadersIfThereAreMultipleHeadersConfigured()
    {
        $stubHeaders = ['My-Custom-Header', 'My-Other-Custom-Header'];
        $this->corsConfigurationMock->method('getAllowedHeaders')->willReturn($stubHeaders);
        $this->assertEquals('My-Custom-Header,My-Other-Custom-Header', $this->provider->getValue());
    }

    /**
     * @dataProvider canApplyDataProvider
     */
    public function testCanApply($headers, $originResult, $isPreflight, $expected)
    {
        $this->corsConfigurationMock->method('getAllowedHeaders')->willReturn($headers);
        $this->corsValidatorMock->method('originIsValid')->willReturn($originResult);
        $this->corsValidatorMock->method('isPreflightRequest')->willReturn($isPreflight);
        $this->assertEquals($expected, $this->provider->canApply(), 'Incorrect canApply result');
    }

    public function canApplyDataProvider()
    {
        return [
            'invalid origin, cors request' => [
                ['My-Valid-Header', 'My-Other-Valid-Header'],
                false,
                false,
                false,
            ],
            'invalid origin, preflight request' => [
                ['My-Valid-Header', 'My-Other-Valid-Header'],
                false,
                true,
                false,
            ],
            'valid origin, cors request without configured headers' => [
                [],
                true,
                false,
                false,
            ],
            'valid origin, preflight request without configured headers' => [
                [],
                true,
                true,
                false,
            ],
            'valid origin, cors request with header configuration' => [
                ['My-Valid-Header', 'My-Other-Valid-Header'],
                true,
                false,
                false,
            ],
            'valid origin, preflight request with header configuration' => [
                ['My-Valid-Header', 'My-Other-Valid-Header'],
                true,
                true,
                true,
            ],
        ];
    }
}
