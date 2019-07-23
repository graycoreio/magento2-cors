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

    public function testItDoesNotPresentAConcretionForTheCorsValidatorInterfaceInTheGlobalScope()
    {
        $this->setArea(Area::AREA_GLOBAL);
        $this->assertNull(
            $this->objectManager->get(CorsValidatorInterface::class)
        );
    }

    public function testItPresentsAConcretionForTheCorsValidatorInterfaceInTheGraphQlScope()
    {
        $this->setArea(Area::AREA_GRAPHQL);
        $this->assertInstanceOf(
            CorsValidator::class,
            $this->objectManager->get(CorsValidatorInterface::class)
        );
    }

    public function testItDoesNotPresentAConcretionForTheCorsConfigurationInterfaceInTheGlobalScope()
    {
        $this->setArea(Area::AREA_GLOBAL);
        $this->assertNull(
            $this->objectManager->get(CorsConfigurationInterface::class)
        );
    }

    public function testItPresentsAConcretionForTheCorsConfigurationInterfaceInTheGraphQlScope()
    {
        $this->setArea(Area::AREA_GRAPHQL);
        $this->assertInstanceOf(
            CorsConfiguration::class,
            $this->objectManager->get(CorsConfigurationInterface::class)
        );
    }
}
