<?php
/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */
namespace Graycore\Cors\Response;

use Magento\Framework\App\Request\Http;
use Magento\Framework\App\RequestInterface;
use Magento\Webapi\Controller\Rest as RestController;
use Magento\Framework\Webapi\Rest\Request as RestRequest;
use Magento\Framework\App\Response\Http as HttpResponse;

/**
 * PreflightRequestHandler is responsible for returning a 
 * 200 response to an options request.
 * 
 * @category  PHP
 * @package   Graycore_Cors
 * @author    Graycore <damien@graycore.io>
 * @copyright Graycore, LLC (https://www.graycore.io/)
 * @license   MIT https://github.com/graycoreio/magento2-cors/license
 * @link      https://github.com/graycoreio/magento2-cors
 */
class PreflightRequestHandler
{

    /** @var HttpResponse */
    private $_response;

    /** @var HeaderManager */
    private $headerManager;

    public function __construct(HttpResponse $response, HeaderManager $headerManager){
        $this->_response = $response;
        $this->_headerManager = $headerManager;
    }

    /**
     * @param RestRequest $subject
     *
     * @return string
     */
    public function aroundDispatch(RestController $subject, callable $next, RequestInterface $request){
        if($request instanceof Http && $request->isOptions()){
            return $this->_headerManager->applyHeaders($this->_response);
        }

        /** @var HttpResponse $response */
        return $next($request);
    }
}
