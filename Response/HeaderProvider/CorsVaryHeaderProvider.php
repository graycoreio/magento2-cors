<?php

/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */

namespace Graycore\Cors\Response\HeaderProvider;

use Graycore\Cors\Validator\CorsValidatorInterface;
use Magento\Framework\App\Response\HeaderProvider\AbstractHeaderProvider;
use Magento\Framework\App\Response\HeaderProvider\HeaderProviderInterface;

/**
 * CorsVaryHeaderProvider is responsible for adding the header
 * Vary Header to a response.
 * @author    Graycore <damien@graycore.io>
 * @copyright Graycore, LLC (https://www.graycore.io/)
 * @license   MIT https://github.com/graycoreio/magento2-cors/license
 * @link      https://github.com/graycoreio/magento2-cors
 */
class CorsVaryHeaderProvider extends AbstractHeaderProvider implements HeaderProviderInterface
{
    /**
     * @var string
     */
    protected $headerName = 'Vary';

    /**
     * @var string
     */
    protected $headerValue = 'Origin';

    /**
     * Since we'll be responding to requests differently per request origin, we now
     * need to ensure that all responses contain the vary header. Otherwise,
     * HTTP caches, like Varnish or the browser cache, will incorrectly cache
     * results because they won't know that the "per origin" behavior could exist.
     *
     * Additionally,
     * ```
     * Vary: Accept-Encoding
     * Vary: Origin
     * ```
     *
     * is the same as
     *
     * ```
     * Vary: Accept-Encoding, Origin
     * ```
     *
     * So, we don't bother attempting to merge the two headers into a comma-separated list.
     *
     * //TODO(damienwebdev): consider the ramifications to cache size if we don't
     * normalize "Vary" this into well organized list.
     */
    public function canApply(): bool
    {
        return true;
    }
}
