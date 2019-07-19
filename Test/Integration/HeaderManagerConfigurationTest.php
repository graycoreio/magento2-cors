<?php
/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */
namespace Graycore\Cors\Test\Integration;

use PHPUnit\Framework\TestCase;

/**
 * Tests that ensure that the CORS headers are properly
 * dependency injected into the HeaderManager
 * @category  PHP
 * @package   Graycore_Cors
 * @author    Graycore <damien@graycore.io>
 * @copyright 2019 Graycore, LLC (https://www.graycore.io/)
 * @license   MIT https://github.com/graycoreio/magento2-cors/license
 * @link      https://github.com/graycoreio/magento2-cors
 */
class HeaderManagerConfigurationTest extends TestCase
{
    public function testTheModuleAddsCorsHeadersInTheGraphQlScope()
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testTheModuleDoesNotAddCorsHeadersInTheGlobalScope()
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }
}
