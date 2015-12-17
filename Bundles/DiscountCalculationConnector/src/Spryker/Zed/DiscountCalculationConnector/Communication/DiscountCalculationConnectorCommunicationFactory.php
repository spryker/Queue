<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Zed\DiscountCalculationConnector\Communication;

use Spryker\Zed\DiscountCalculationConnector\Business\DiscountCalculationConnectorFacade;
use Spryker\Zed\DiscountCalculationConnector\Dependency\Facade\DiscountFacadeInterface;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

class DiscountCalculationConnectorCommunicationFactory extends AbstractCommunicationFactory
{

    /**
     * @return DiscountFacadeInterface
     */
    public function getDiscountFacade()
    {
        return $this->getLocator()->discount()->facade();
    }

    /**
     * @return DiscountCalculationConnectorFacade
     */
    public function getDiscountCalculationFacade()
    {
        return $this->getLocator()->discountCalculationConnector()->facade();
    }

}