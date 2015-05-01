<?php

namespace Unit\SprykerFeature\Zed\Discount\Business\Calculator;

use Codeception\TestCase\Test;
use SprykerFeature\Zed\Discount\Business\Calculator\Percentage;
use SprykerEngine\Zed\Kernel\Locator;
use SprykerFeature\Shared\Sales\Transfer\OrderItem;

/**
 * Class PercentageTest
 * @group DiscountCalculatorPercentageTest
 * @group Discount
 * @package Unit\SprykerFeature\Zed\Discount\Business\Calculator
 */
class PercentageTest extends \PHPUnit_Framework_TestCase
{
    const ITEM_GROSS_PRICE_1000 = 1000;
    const DISCOUNT_PERCENTAGE_10 = 10;
    const DISCOUNT_PERCENTAGE_100 = 100;
    const DISCOUNT_PERCENTAGE_200 = 200;

    public function testCalculatePercentageShouldNotGrantDiscountsHigherThanHundredPercent()
    {
        $items = $this->getItems(
            [
                self::ITEM_GROSS_PRICE_1000,
                self::ITEM_GROSS_PRICE_1000,
                self::ITEM_GROSS_PRICE_1000,
            ]
        );

        $calculator = new Percentage();
        $discountAmount = $calculator->calculate($items, self::DISCOUNT_PERCENTAGE_200);

        $this->assertEquals(self::ITEM_GROSS_PRICE_1000 * 3, $discountAmount);
    }

    public function testCalculatePercentageShouldNotGrantDiscountsLessThanZeroPercent()
    {
        $items = $this->getItems(
            [
                self::ITEM_GROSS_PRICE_1000,
                self::ITEM_GROSS_PRICE_1000,
                self::ITEM_GROSS_PRICE_1000,
            ]
        );

        $calculator = new Percentage();
        $discountAmount = $calculator->calculate($items, -1 * self::DISCOUNT_PERCENTAGE_200);

        $this->assertEquals(0, $discountAmount);
    }

    public function testCalculatePercentageShouldThrowAnExceptionForNonNumericValues()
    {
        $items = $this->getItems(
            [
                self::ITEM_GROSS_PRICE_1000,
                self::ITEM_GROSS_PRICE_1000,
                self::ITEM_GROSS_PRICE_1000,
            ]
        );

        $calculator = new Percentage();
        $this->setExpectedException('InvalidArgumentException');
        $discountAmount = $calculator->calculate($items, 'string');
    }

    public function testCalculatePercentageShouldNotGiveNegativeDiscountAmounts()
    {
        $items = $this->getItems(
            [
                -1 * self::ITEM_GROSS_PRICE_1000,
                -1 * self::ITEM_GROSS_PRICE_1000,
                -1 * self::ITEM_GROSS_PRICE_1000,
            ]
        );

        $calculator = new Percentage();
        $discountAmount = $calculator->calculate($items, self::DISCOUNT_PERCENTAGE_10);

        $this->assertEquals(0, $discountAmount);
    }

    /**
     * @param array $grossPrices
     * @return OrderItem[]
     */
    protected function getItems(array $grossPrices)
    {
        $items = [];

        foreach ($grossPrices as $grossPrice) {
            $item = new \Generated\Shared\Transfer\SalesOrderItemTransfer();
            $item->setGrossPrice($grossPrice);
            $items[] = $item;
        }

        return $items;
    }
}