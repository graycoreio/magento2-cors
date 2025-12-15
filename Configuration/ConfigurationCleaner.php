<?php

/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */

namespace Graycore\Cors\Configuration;

/**
 * ConfigurationCleaner is responsible processing end-user specified configuration values
 * into values utilizable by the module.
 * @copyright Graycore, LLC (https://www.graycore.io/)
 * @license   MIT https://github.com/graycoreio/magento2-cors/license
 * @link      https://github.com/graycoreio/magento2-cors
 */
class ConfigurationCleaner
{
    /**
     * Process a delimited string into an array. The delimiter is assumed to be a comma by default.
     *
     * @param string $string
     * @param string $delimiter
     * @return array
     */
    public function processDelimitedString($string, $delimiter = ',')
    {
        if (empty($string)) {
            return [];
        }
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
