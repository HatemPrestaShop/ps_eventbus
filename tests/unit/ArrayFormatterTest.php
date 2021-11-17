<?php

use PHPUnit\Framework\TestCase;
use PrestaShop\Module\PsEventbus\Formatter\ArrayFormatter;
use Yandex\Allure\Adapter\Annotation\Features;
use Yandex\Allure\Adapter\Annotation\Stories;
use Yandex\Allure\Adapter\Annotation\Title;

/**
 * @Features("formatter")
 * @Stories("array formatter")
 */
class ArrayFormatterTest extends TestCase
{
    /**
     * @var ArrayFormatter
     */
    private $arrayFormatter;

    protected function setUp()
    {
        $this->arrayFormatter = new ArrayFormatter();
    }

    /**
     * @Stories("array formatter")
     * @Title("testFormatArray")
     */
    public function testFormatArray()
    {
        $data = [
            'value1',
            'value2',
        ];

        $this->assertEquals('value1;value2', $this->arrayFormatter->arrayToString($data));
        $this->assertEquals('value1:value2', $this->arrayFormatter->arrayToString($data, ':'));
    }

    /**
     * @Stories("arrayFormatter")
     * @Title("testFormatValueArrayTest")
     */
    public function testFormatValueArrayTest()
    {
        $data = [
            ['id' => 1, 'value' => 123],
            ['id' => 2, 'value' => 456],
            ['id' => 3, 'value' => 789],
        ];

        $this->assertEquals('123;456;789', $this->arrayFormatter->formatValueString($data, 'value'));
        $this->assertEquals('123:456:789', $this->arrayFormatter->formatValueString($data, 'value', ':'));
    }
}
