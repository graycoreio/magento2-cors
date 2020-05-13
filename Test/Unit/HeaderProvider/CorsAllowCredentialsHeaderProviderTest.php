<?php
/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */
namespace Graycore\Cors\Test\Unit\HeaderProvider;

use Graycore\Cors\Response\HeaderProvider\CorsAllowCredentialsHeaderProvider;
use Graycore\Cors\Configuration\CorsConfigurationInterface;
use Graycore\Cors\Validator\CorsValidatorInterface;

/**
 * Tests that the CORS AllowCredentials header
 * is properly applied to a response
 * @author    Matthew O'Loughlin <matthew@aligent.com.au>
 * @copyright Graycore, LLC (https://www.graycore.io/)
 * @license   MIT https://github.com/graycoreio/magento2-cors/license
 * @link      https://github.com/graycoreio/magento2-cors
 */
class CorsAllowCredentialsHeaderProviderTest extends \PHPUnit\Framework\TestCase
{
    /** Access-Control-Allow-Credentials Header name */
    const HEADER_NAME = 'Access-Control-Allow-Credentials';

    /**
     * @var CorsAllowCredentialsHeaderProvider
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
        $this->provider = new CorsAllowCredentialsHeaderProvider(
            $this->corsConfigurationMock,
            $this->corsValidatorMock
        );
    }

    public function testGetName()
    {
        $this->assertEquals($this::HEADER_NAME, $this->provider->getName(), 'Wrong header name');
    }

    public function testNotAppliedIfNotConfigured()
    {
        $this->corsConfigurationMock->method('getAllowCredentials')->willReturn(false);
        $this->corsValidatorMock->method('originIsValid')->willReturn(true);
        $this->assertEquals(false, $this->provider->canApply(), 'Incorrectly applied header');
    }

    public function testHeaderAppliedIfConfigured()
    {
        $this->corsConfigurationMock->method('getAllowCredentials')->willReturn(true);
        $this->corsValidatorMock->method('originIsValid')->willReturn(true);
        $this->assertEquals(true, $this->provider->canApply());
        $this->assertEquals('true', $this->provider->getValue());
    }
}
