<?php

namespace Graycore\Cors\Controller;

use Graycore\Cors\Response\HeaderManager;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\Response\Http as ResponseHttp;

class NoopController
{

    /**
     * @var HeaderManager
     */
    private $_headerManager;

    /**
     * @var ResponseHttp
     */
    private $_response;

    /**
     * NoopController constructor.
     *
     * @param HeaderManager $headerManager
     * @param ResponseHttp $response
     */
    public function __construct(
        HeaderManager $headerManager,
        ResponseHttp $response
    ) {
        $this->_headerManager = $headerManager;
        $this->_response = $response;
    }

    /**
     * Dispatch application action
     *
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function dispatch(RequestInterface $request)
    {
        $this->_headerManager->applyHeaders($this->_response);
        return $this->_response;
    }
}
