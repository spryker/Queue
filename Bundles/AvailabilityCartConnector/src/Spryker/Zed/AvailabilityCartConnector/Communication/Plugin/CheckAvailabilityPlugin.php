<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Zed\AvailabilityCartConnector\Communication\Plugin;

use Spryker\Zed\AvailabilityCartConnector\Communication\AvailabilityCartConnectorDependencyContainer as DependencyContainer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method DependencyContainer getDependencyContainer()
 */
class CheckAvailabilityPlugin extends AbstractPlugin
{

    /**
     * @param string $sku
     * @param int $quantity
     *
     * @return bool
     */
    public function isProductSellable($sku, $quantity)
    {
        return $this->getDependencyContainer()->getAvailabilityFacade()->isProductSellable($sku, $quantity);
    }

    /**
     * @param string $sku
     *
     * @return int
     */
    public function calculateStockForProduct($sku)
    {
        return $this->getDependencyContainer()->getAvailabilityFacade()->calculateStockForProduct($sku);
    }

}