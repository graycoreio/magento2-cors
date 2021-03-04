<?php

/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */

namespace Graycore\Cors\Response\HeaderProvider;

use Graycore\Cors\Validator\CorsValidatorInterface;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * Tests that the Vary header is properly applied to a response
 * @author    Graycore <damien@graycore.io>
 * @copyright Graycore, LLC (https://www.graycore.io/)
 * @license   MIT https://github.com/graycoreio/magento2-cors/license
 * @link      https://github.com/graycoreio/magento2-cors
 */
class CorsVaryHeaderProviderTest extends \PHPUnit\Framework\TestCase
{
    /** Vary Header name */
    const HEADER_NAME = 'Vary';

    /**
     * Vary Header value
     */
    const HEADER_VALUE = 'Origin';

    /**
     * @var CorsVaryHeaderProvider
     */
    protected $provider;

    /**
     * @var CorsValidatorInterface|MockObject
     */
    protected $corsValidatorMock;

    protected function setUp(): void
    {
        $this->provider = new CorsVaryHeaderProvider();
    }

    public function testGetName()
    {
        $this->assertEquals($this::HEADER_NAME, $this->provider->getName(), 'Wrong header name');
    }

    public function testGetValue()
    {
        $this->assertEquals($this::HEADER_VALUE, $this->provider->getValue(), 'Wrong default header value');
    }

    public function testCanApply()
    {
        $this->assertEquals(true, $this->provider->canApply(), 'Incorrect canApply result');
    }
}
