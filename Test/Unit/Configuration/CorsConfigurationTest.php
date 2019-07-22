<?php
/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */
namespace Graycore\Cors\Test\Unit\Configuration;

use Graycore\Cors\Configuration\CorsConfiguration;
use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Tests that the Cors Configuration object properly
 * retrieves, parses and transforms configuration
 * settings from Magento configuration.
 * @category  PHP
 * @package   Graycore_Cors
 * @author    Graycore <damien@graycore.io>
 * @copyright Graycore, LLC (https://www.graycore.io/)
 * @license   MIT https://github.com/graycoreio/magento2-cors/license
 * @link      https://github.com/graycoreio/magento2-cors
 */
class CorsConfigurationTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var CorsConfiguration
     */
    protected $configuration;

    /**
     * @var ScopeConfigInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $scopeConfigMock;

    protected function setUp()
    {
        $this->scopeConfigMock = $this->createMock(ScopeConfigInterface::class);
        $this->configuration = new CorsConfiguration($this->scopeConfigMock);
    }

    public function testItReturnsAnArrayOfAllowedOrigins()
    {
        $this->scopeConfigMock->method('getValue')->willReturn('https://www.example.com');
        $this->assertEquals(['https://www.example.com'], $this->configuration->getAllowedOrigins());
    }

    public function testIfTheConfigurationIsEmptyItWillReturnAnEmptyArray()
    {
        $this->scopeConfigMock->method('getValue')->willReturn('');
        $this->assertEquals([], $this->configuration->getAllowedOrigins());
    }

    public function testIfTheConfigurationIsNullItWillReturnAnEmptyArray()
    {
        $this->scopeConfigMock->method('getValue')->willReturn(null);
        $this->assertEquals([], $this->configuration->getAllowedOrigins());
    }

    public function testIfTheConfigurationIsACommaSeparatedStringWithSpacesInItThenItWillReturnAnArrayOfOrigins()
    {
        $this->scopeConfigMock
            ->method('getValue')->willReturn('https://www.example.com, ,https://www.myother.valid.domain ');
        $this->assertEquals(
            ['https://www.example.com', 'https://www.myother.valid.domain'],
            $this->configuration->getAllowedOrigins()
        );
    }
}
