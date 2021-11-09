<?php

use PrestaShop\Module\PsEventbus\Controller\AbstractApiController;
use PrestaShop\Module\PsEventbus\Provider\CustomPriceDataProvider;

class ps_EventbusApiCustomPricesModuleFrontController extends AbstractApiController
{
    public $type = 'price';

    /**
     * @throws PrestaShopException
     *
     * @return void
     */
    public function postProcess()
    {
        $productDataProvider = $this->module->getService(CustomPriceDataProvider::class);

        $response = $this->handleDataSync($productDataProvider);

        $this->exitWithResponse($response);
    }
}
