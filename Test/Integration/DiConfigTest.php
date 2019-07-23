<?php
/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */
namespace Graycore\Cors\Test\Integration;

use PHPUnit\Framework\TestCase;
use Magento\TestFramework\App\State as AppAreaState;
use Magento\Framework\App\Area;
use Magento\TestFramework\ObjectManager;
use Graycore\Cors\Configuration\CorsConfiguration;
use Graycore\Cors\Configuration\CorsConfigurationInterface;
use Graycore\Cors\Validator\CorsValidatorInterface;
use Graycore\Cors\Validator\CorsValidator;

/**
 * Tests that the Dependency Injection for the module is setup correctly.
 * @category  PHP
 * @package   Graycore_Cors
 * @author    Graycore <damien@graycore.io>
 * @copyright Graycore, LLC (https://www.graycore.io/)
 * @license   MIT https://github.com/graycoreio/magento2-cors/license
 * @link      https://github.com/graycoreio/magento2-cors
 */
class DiConfigTest extends TestCase
{
    /** @var ObjectManager */
    private $objectManager;

    /**
     * @param string $area
     */
    private function setArea(string $area)
    {
        /** @var AppAreaState $appArea */
        $appArea = $this->objectManager->get(AppAreaState::class);
        $appArea->setAreaCode($area);
    }

    public function setUp()
    {
        $this->objectManager = ObjectManager::getInstance();
    }

    /**
     * @magentoAppArea global
     */
    public function testItDoesNotPresentAConcretionForTheCorsValidatorInterfaceInTheGlobalScope()
    {
        $this->expectException(\Error::class, "Cannot instantiate interface Graycore\Cors\Validator\CorsValidatorInterface");
        $this->objectManager->get(CorsValidatorInterface::class);
    }

    /**
     * @magentoAppArea graphql
     */
    public function testItPresentsAConcretionForTheCorsValidatorInterfaceInTheGraphQlScope()
    {
        $this->assertInstanceOf(
            CorsValidator::class,
            $this->objectManager->get(CorsValidatorInterface::class)
        );
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
            CorsConfiguration::class,
            $this->objectManager->get(CorsConfigurationInterface::class)
        );
    }
}
