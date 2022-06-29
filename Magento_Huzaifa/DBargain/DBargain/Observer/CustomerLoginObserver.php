<?php declare(strict_types=1);


namespace DBargain\DBargain\Observer;

use Magento\Customer\Model\Session;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Event\ObserverInterface;

class CustomerLoginObserver implements ObserverInterface
{
    private \Magento\Framework\DB\Adapter\AdapterInterface $connection;
    private Session $customerSession;

    public function __construct(Session $customerSession)
    {
        $resources             = ObjectManager::getInstance()->get('Magento\Framework\App\ResourceConnection');
        $this->connection      = $resources->getConnection();
        $this->customerSession = $customerSession;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $customer = $observer->getEvent()->getCustomer();
        $sql      = 'UPDATE `bargain` SET customer_id = ? WHERE session_id = ?';
        $this->connection->query($sql, [$customer->getId(), $this->customerSession->getSessionId()]);

    }
}
