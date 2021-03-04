<?php

/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */

namespace Graycore\Cors\Response\Preflight\GraphQl;

use Magento\Framework\App\Request\Http;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Response\Http as HttpResponse;
use Magento\GraphQl\Controller\GraphQl as GraphQlController;
use Magento\Framework\App\Response\HeaderManager;

/**
 * PreflightRequestHandler is responsible for returning a
 * 200 response to an options request on the graphql endpoint.
 *
 * @author    Matthew O'Loughlin <matthew@aligent.com.au>
 * @copyright Graycore, LLC (https://www.graycore.io/)
 * @license   MIT https://github.com/graycoreio/magento2-cors/license
 * @link      https://github.com/graycoreio/magento2-cors
 */
class PreflightRequestHandler
{

    /** @var HttpResponse */
    private $_response;

    /** @var HeaderManager */
    private $_headerManager;

    public function __construct(HttpResponse $response, HeaderManager $headerManager)
    {
        $this->_response = $response;
        $this->_headerManager = $headerManager;
    }

    /**
     * @param GraphQlController $subject
     * @param callable $next
     * @param RequestInterface $request
     * @return \Magento\Framework\App\Response\HttpInterface
     */
    public function aroundDispatch(GraphQlController $subject, callable $next, RequestInterface $request)
    {
        if ($request instanceof Http && $request->isOptions()) {
            $this->_headerManager->beforeSendResponse($this->_response);
            $this->_response->setPublicHeaders(86400);
            return $this->_response;
        }

        return $next($request);
    }
}
