<?php
/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */
namespace Graycore\Cors\Configuration;

/**
 * ConfigurationCleaner is responsible processing end-user specified configuration values
 * into values utilizable by the module.
 * @category  PHP
 * @package   Graycore_Cors
 * @author    Graycore <damien@graycore.io>
 * @copyright Graycore, LLC (https://www.graycore.io/)
 * @license   MIT https://github.com/graycoreio/magento2-cors/license
 * @link      https://github.com/graycoreio/magento2-cors
 */
class ConfigurationCleaner
{
    
    public function processDelimitedString($string, $delimiter = ',')
    {
        $configuration = explode($delimiter, $string);
        $cleanedConfiguration = [];
        $cleanedConfiguration = array_map(
            function ($item) {
                return trim($item);
            },
            $configuration
        );

        $cleanedConfiguration = array_values(array_filter($cleanedConfiguration, function ($item) {
            return !empty($item) ? true : false;
        }));
        return $cleanedConfiguration;
    }    
}
