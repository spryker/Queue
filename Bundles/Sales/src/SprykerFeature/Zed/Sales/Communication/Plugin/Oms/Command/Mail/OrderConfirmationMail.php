<?php
namespace SprykerFeature\Zed\Sales\Business\Model\Orderprocess\Command\Mail;

use SprykerFeature\Zed\Oms\Business\Util\ReadOnlyArrayObject;
use SprykerFeature\Zed\Oms\Communication\Plugin\Oms\Command\CommandByOrderInterface;
use SprykerFeature\Zed\Sales\Communication\Plugin\Oms\Command\AbstractMail;
use SprykerFeature\Zed\Sales\Persistence\Propel\SpySalesOrder;

class OrderConfirmationMail extends AbstractMail implements
    CommandByOrderInterface
{

    /**
     * @param array $orderItems
     * @param SpySalesOrder $orderEntity
     * @param ReadOnlyArrayObject $data
     */
    public function run(array $orderItems, SpySalesOrder $orderEntity, ReadOnlyArrayObject $data)
    {
        $mailTransfer = $this->facadeMail->buildOrderMailTransfer(
            MailTypesConstantInterface::ORDER_CONFIRMATION,
            $orderItems
        );
        $result = $this->facadeMail->sendMail($mailTransfer);
        $this->handleResponse($result, $mailTransfer, $orderEntity);
    }
}
