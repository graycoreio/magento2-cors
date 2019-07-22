<?php
/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */
namespace Graycore\Cors\Test\Unit\Validator;

use Graycore\Cors\Configuration\CorsConfigurationInterface;
use Graycore\Cors\Validator\CorsValidator;
use Magento\Framework\App\Request\Http;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager as ObjectManagerHelper;

/**
 * Tests the request validation that verifies
 * that the CORS headers should be added to a request.
 * @category  PHP
 * @package   Graycore_Cors
 * @author    Graycore <damien@graycore.io>
 * @copyright Graycore, LLC (https://www.graycore.io/)
 * @license   MIT https://github.com/graycoreio/magento2-cors/license
 * @link      https://github.com/graycoreio/magento2-cors
 */
class CorsValidatorTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var CorsValidator
     */
    protected $validator;

    /**
     * @var CorsConfigurationInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $configurationMock;

    /**
     * @var Http|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $requestMock;

    protected function setUp()
    {
        $this->configurationMock = $this->createMock(CorsConfigurationInterface::class);
        $this->requestMock = $this->createMock(Http::class);
        $this->validator = new CorsValidator($this->configurationMock, $this->requestMock);
    }

    /**
     * @dataProvider originIsValidDataProvider
     */
    public function testOriginIsValid($allowedOrigins, $requestOrigin, $expected)
    {
        $this->configurationMock->method('getAllowedOrigins')->willReturn($allowedOrigins);
        $this->requestMock->method('getHeader')->willReturn($requestOrigin);
        return $this->assertEquals($expected, $this->validator->originIsValid());
    }

    public function originIsValidDataProvider()
    {
        return [
            'valid origin' => [
                ['https://www.example.com'],
                'https://www.example.com',
                true,
            ],
            'valid origin with multiple configured origins' => [
                ['https://www.example.com', 'https://www.myotherexample.com'],
                'https://www.example.com',
                true,
            ],
            'invalid origin with configured origins' => [
                ['https://www.example.com', 'https://www.myotherexample.com'],
                'https://www.amalicicousdomain.com',
                false,
            ],
            'valid origin domain with invalid origin protocol (http)' => [
                ['https://www.example.com'],
                'http://www.example.com',
                false,
            ],
            'valid origin domain with invalid origin protocol (https)' => [
                ['http://www.example.com'],
                'https://www.example.com',
                false,
            ],
            'invalid origin with no configured origins' => [
                [],
                'https://www.amalicicousdomain.com',
                false,
            ],
            'any origin with a wildcard configured' => [
                ['*'],
                'https://some.random.domain',
                true,
            ],
        ];
    }
}
