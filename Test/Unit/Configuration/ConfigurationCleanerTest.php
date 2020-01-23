<?php
/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */
namespace Graycore\Cors\Test\Unit\Configuration;

use Graycore\Cors\Configuration\ConfigurationCleaner;
use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * @author    Graycore <damien@graycore.io>
 * @copyright Graycore, LLC (https://www.graycore.io/)
 * @license   MIT https://github.com/graycoreio/magento2-cors/license
 * @link      https://github.com/graycoreio/magento2-cors
 */
class ConfigurationCleanerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var configurationCleaner
     */
    protected $configurationCleaner;

    protected function setUp(): void
    {
        $this->configurationCleaner = new ConfigurationCleaner();
    }
    public function testItProperlyCleansArray()
    {
        $string = "1, 2, 3, 4";
        $this->assertEquals(["1","2","3","4"], $this->configurationCleaner->processDelimitedString($string));
        $string = "1,, 2,, 3, 4";
        $this->assertEquals(["1","2","3","4"], $this->configurationCleaner->processDelimitedString($string));
    }
}
