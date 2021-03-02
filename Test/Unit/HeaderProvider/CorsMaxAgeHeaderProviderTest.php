<?php
/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */
namespace Graycore\Cors\Test\Unit\HeaderProvider;

use Graycore\Cors\Configuration\CorsConfigurationInterface;
use Graycore\Cors\Response\HeaderProvider\CorsMaxAgeHeaderProvider;
use Graycore\Cors\Validator\CorsValidator;
use Graycore\Cors\Validator\CorsValidatorInterface;

/**
 * Tests that the CORS MaxAge header
 * is properly applied to a response
 * @author    Graycore <damien@graycore.io>
 * @copyright Graycore, LLC (https://www.graycore.io/)
 * @license   MIT https://github.com/graycoreio/magento2-cors/license
 * @link      https://github.com/graycoreio/magento2-cors
 */
class CorsMaxAgeHeaderProviderTest extends \PHPUnit\Framework\TestCase
{
    /** Access-Control-Max-Age Header name */
    const HEADER_NAME = 'Access-Control-Max-Age';

    /**
     * Access-Control-Max-Age Header value
     */
    const HEADER_VALUE = '86400';

    /**
     * @var CorsMaxAgeHeaderProvider
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
        $this->provider = new CorsMaxAgeHeaderProvider($this->corsConfigurationMock, $this->corsValidatorMock);
    }

    public function testGetName()
    {
        $this->assertEquals($this::HEADER_NAME, $this->provider->getName(), 'Wrong header name');
    }

    public function testGetValue()
    {
        $this->assertEquals($this::HEADER_VALUE, $this->provider->getValue(), 'Wrong default header value');
    }

    /**
     * @dataProvider canApplyDataProvider
     */
    public function testCanApply($maxAge, $originResult, $isPreflightRequest, $expected)
    {
        $this->corsConfigurationMock->method('getMaxAge')->willReturn($maxAge);
        $this->corsValidatorMock->method('originIsValid')->willReturn($originResult);
        $this->corsValidatorMock->method('isPreflightRequest')->willReturn($isPreflightRequest);
        $this->assertEquals($expected, $this->provider->canApply(), 'Incorrect canApply result');
    }

    public function canApplyDataProvider()
    {
        return [
            'invalid origin, cors request' => [
                '1000',
                false,
                false,
                false,
            ],
            'invalid origin, preflight request' => [
                '1000',
                false,
                true,
                false,
            ],
            'valid origin, cors request with null configured maxAge' => [
                null,
                true,
                false,
                false,
            ],
            'valid origin, preflight request with null configured maxAge' => [
                null,
                true,
                true,
                true,
            ],
            'valid origin, cors request with empty configured maxAge' => [
                '',
                true,
                false,
                false,
            ],
            'valid origin, preflight request with empty configured maxAge' => [
                '',
                true,
                true,
                true,
            ],
            'valid origin, cors request with configured age' => [
                '86400',
                true,
                false,
                false,
            ],
            'valid origin, preflight request with configured age' => [
                '86400',
                true,
                true,
                true,
            ],
        ];
    }
}
