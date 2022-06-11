<?php

namespace Graycore\Cors\Plugin;

use Magento\Framework\App\AreaList;
use Magento\Framework\App\State;
use Magento\Framework\ObjectManager\ConfigLoaderInterface;
use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\App\Request\Http as RequestHttp;

class FastLauncher
{
    /**
     * @var ObjectManagerInterface
     */
    private $_objectManager;

    /**
     * @var AreaList
     */
    private $_areaList;

    /**
     * @var ConfigLoaderInterface
     */
    private $_configLoader;

    /**
     * @var State
     */
    private $_state;

    /**
     * @var RequestHttp
     */
    private $_request;

    /**
     * @param ObjectManagerInterface $objectManager
     * @param AreaList $areaList
     * @param ConfigLoaderInterface $configLoader
     * @param State $state
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        AreaList $areaList,
        RequestHttp $request,
        ConfigLoaderInterface $configLoader,
        State $state
    ) {
        $this->_objectManager = $objectManager;
        $this->_areaList = $areaList;
        $this->_configLoader = $configLoader;
        $this->_state = $state;
        $this->_request = $request;
    }

    public function aroundLaunch(\Magento\Framework\AppInterface $subject, callable $proceed)
    {
        if ($this->_request->getMethod() === RequestHttp::METHOD_OPTIONS) {
            $areaCode = $this->_areaList->getCodeByFrontName($this->_request->getFrontName());
            $this->_state->setAreaCode($areaCode);
            $this->_objectManager->configure($this->_configLoader->load($areaCode));
            /** @var \Graycore\Cors\Controller\NoopController::class */
            $controller = $this->_objectManager->get(\Graycore\Cors\Controller\NoopController::class);
            $response = $controller->dispatch($this->_request);
            return $response;
        };

        return $proceed();
    }
}
