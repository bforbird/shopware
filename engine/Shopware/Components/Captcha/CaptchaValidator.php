<?php

declare(strict_types=1);
/**
 * Shopware 5
 * Copyright (c) shopware AG
 *
 * According to our licensing model, this program can be used
 * under the terms of the GNU Affero General Public License, version 3.
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission can be found at and in the LICENSE file you have received
 * along with this program.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU Affero General Public License for more details.
 *
 * "Shopware" is a registered trademark of shopware AG.
 * The licensing of the program under the AGPLv3 does not imply a
 * trademark license. Therefore, any rights, title and interest in
 * our trademarks remain entirely with the shopware AG.
 */

namespace Shopware\Components\Captcha;

use Enlight_Controller_Request_Request;
use Shopware\Components\Captcha\Exception\CaptchaNotFoundException;

class CaptchaValidator
{
    private CaptchaRepository $repository;

    public function __construct(CaptchaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Validates a Request using the currently configured captcha
     *
     * @throws CaptchaNotFoundException
     *
     * @return bool
     */
    public function validate(Enlight_Controller_Request_Request $request)
    {
        return $this->validateByName(
            $this->repository->getConfiguredCaptcha()->getName(),
            $request
        );
    }

    /**
     * Validates a custom captcha by the template name which has passed in the request
     *
     * @param string $name
     *
     * @throws CaptchaNotFoundException
     *
     * @return bool
     */
    public function validateByName($name, Enlight_Controller_Request_Request $request)
    {
        return $this->repository->getCaptchaByName($name)->validate($request);
    }
}
