<?php

namespace PrestaShop\Module\PsEventbus\Tests\System\Tests\Provider;

use PrestaShop\Module\PsEventbus\Config\Config;
use PrestaShop\Module\PsEventbus\Provider\CustomPriceDataProvider;
use PrestaShop\Module\PsEventbus\Provider\CustomProductCarrierDataProvider;
use PrestaShop\Module\PsEventbus\Provider\PaginatedApiDataProviderInterface;
use PrestaShop\Module\PsEventbus\Tests\System\Tests\BaseTestCase;
use Product;

class CustomProductCarrierDataProviderTest extends BaseTestCase
{
    public function setUp()
    {
        parent::setUp();
        $product = new Product(1);
        $product->setCarriers([1,2]);
    }

    /**
     * @dataProvider getDataProviderInfo
     */
    public function testDataProviders(PaginatedApiDataProviderInterface $dataProvider, array $result)
    {
        $formattedData = $dataProvider->getFormattedData(0, 50, 'en');
        $this->assertEquals($result, $formattedData);
    }

    public function getDataProviderInfo()
    {
        return [
            'custom price provider' => [
                'provider' => $this->container->getService(CustomProductCarrierDataProvider::class),
                'result' => [
                        0 => [
                                'id' => '1-1',
                                'collection' => Config::COLLECTION_CUSTOM_PRODUCT_CARRIER,
                                'properties' => [
                                        'id_product' => 1,
                                        'id_carrier_reference' => 1
                                    ],
                            ],
                        1 => [
                            'id' => '1-2',
                            'collection' => Config::COLLECTION_CUSTOM_PRODUCT_CARRIER,
                            'properties' => [
                                'id_product' => 1,
                                'id_carrier_reference' => 2
                            ],
                        ],
                    ],
            ],
        ];
    }
}
