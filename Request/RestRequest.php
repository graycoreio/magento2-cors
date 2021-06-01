<?php

/**
 * @copyright Copyright 2017 SplashLab
 */
/**
 * Copyright © Graycore, LLC. All rights reserved.
 * See LICENSE.md for details.
 */

namespace Graycore\Cors\Request;

use Magento\Framework\Webapi\Request;
use Magento\Framework\Exception\InputException;

class RestRequest
{
    /**
     * Triggers before original dispatch
     *
     * @param  Request $subject
     * @return void
     * @throws InputException
     */
    public function aroundGetHttpMethod(
        Request $subject
    ) {
        if (!$subject->isGet()
            && !$subject->isPost()
            && !$subject->isPut()
            && !$subject->isDelete()
            && !$subject->isOptions()
        ) {
            throw new InputException(__('Request method is invalid.'));
        }
        return $subject->getMethod();
    }
}
