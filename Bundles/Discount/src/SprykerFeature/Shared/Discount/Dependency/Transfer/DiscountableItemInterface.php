<?php

namespace SprykerFeature\Shared\Discount\Dependency\Transfer;

use SprykerFeature\Shared\Calculation\Dependency\Transfer\CalculableItemInterface;

interface DiscountableItemInterface extends CalculableItemInterface
{

    /**
     * @return float
     */
    public function getGrossPrice();

    /**
     * @return DiscountItemInterface[]|DiscountableItemCollectionInterface
     */
    public function getDiscounts();

    /**
     * @param DiscountableItemCollectionInterface $collection
     *
     * @return $this
     */
    public function setDiscounts(DiscountableItemCollectionInterface $collection);

    /**
     * @return DiscountableOptionsInterface[]
     */
    public function getOptions();

    /**
     * @return DiscountableExpenseInterface[]
     */
    public function getExpenses();
}