<?php
/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */
namespace Graycore\Cors\Test\Integration;

use PHPUnit\Framework\TestCase;
use Magento\TestFramework\ObjectManager;
use Graycore\Cors\Configuration\CorsConfigurationInterface;
use Graycore\Cors\Configuration\GraphQl\CorsConfiguration as GraphQlCorsConfiguration;
use Graycore\Cors\Configuration\Rest\CorsConfiguration as RestCorsConfiguration;


/**
 * Tests that the Dependency Injection for the module is setup correctly.
 * @category  PHP
 * @package   Graycore_Cors
 * @author    Graycore <damien@graycore.io>
 * @copyright Graycore, LLC (https://www.graycore.io/)
 * @license   MIT https://github.com/graycoreio/magento2-cors/license
 * @link      https://github.com/graycoreio/magento2-cors
 */
class CorsConfigurationDiTest extends TestCase
{
    /** @var ObjectManager */
    private $objectManager;

    public function setUp()
    {
        $this->objectManager = ObjectManager::getInstance();
    }

    /**
     * @magentoAppArea global
     */
    public function testItDoesNotPresentAConcretionForTheCorsConfigurationInterfaceInTheGlobalScope()
    {
        $this->expectException(\Error::class, "Cannot instantiate interface Graycore\Cors\Validator\CorsConfigurationInterface");
        $this->objectManager->get(CorsConfigurationInterface::class);
    }

    /**
     * @magentoAppArea graphql
     */
    public function testItPresentsAConcretionForTheCorsConfigurationInterfaceInTheGraphQlScope()
    {
        $this->assertInstanceOf(
            GraphQlCorsConfiguration::class,
            $this->objectManager->get(CorsConfigurationInterface::class)
        );
    }

    /**
     * @magentoAppArea webapi_rest
     */
    public function testItPresentsAConcretionForTheCorsConfigurationInterfaceInTheRestScope()
    {
        $this->assertInstanceOf(
            RestCorsConfiguration::class,
            $this->objectManager->get(CorsConfigurationInterface::class)
        );
    }
}
