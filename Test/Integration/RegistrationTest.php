<?php
/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */
namespace Graycore\Cors\Test\Integration;

use Magento\Framework\Component\ComponentRegistrar;
use Magento\Framework\Module\ModuleList;
use Magento\TestFramework\ObjectManager;
use PHPUnit\Framework\TestCase;

/**
 * Tests that ensure that the CORS module gets registered properly into the
 * Magento application.
 * @category  PHP
 * @package   Graycore_Cors
 * @author    Graycore <damien@graycore.io>
 * @copyright 2019 Graycore, LLC (https://www.graycore.io/)
 * @license   MIT https://github.com/graycoreio/magento2-cors/license
 * @link      https://github.com/graycoreio/magento2-cors
 */
class RegistrationTest extends TestCase
{
    private $moduleName = "Graycore_Cors";

    public function testItRegistersTheModuleIntoMagento()
    {
        $registrar = new ComponentRegistrar();
        $this->assertArrayHasKey($this->moduleName, $registrar->getPaths(ComponentRegistrar::MODULE));
    }

    public function testTheModuleIsConfiguredAndEnabled()
    {
        $manager = ObjectManager::getInstance();
        $moduleList = $manager->create(ModuleList::class);

        $this->assertTrue($moduleList->has($this->moduleName));
    }
}
