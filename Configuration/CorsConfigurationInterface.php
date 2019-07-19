<?php
/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */
namespace Graycore\Cors\Configuration;

/**
 * CorsConfigurationInterface is a generic interface
 * that describes what types of configuration one would need to
 * implement CORS from a the "Resource" side.
 * @category  PHP
 * @package   Graycore_Cors
 * @author    Graycore <damien@graycore.io>
 * @copyright Graycore, LLC (https://www.graycore.io/)
 * @license   MIT https://github.com/graycoreio/magento2-cors/license
 * @link      https://github.com/graycoreio/magento2-cors
 */
interface CorsConfigurationInterface
{
    /**
     * @return string[];
     */
    public function getAllowedOrigins(): array;

    /**
     * @return string[];
     */
    public function getAllowedHeaders(): array;

    /**
     * @return string[];
     */
    public function getAllowedMethods(): array;

    /**
     * @return string;
     */
    public function getMaxAge(): ?string;
}
