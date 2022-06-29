<?php declare(strict_types=1);


namespace DBargain\DBargain\Observer;


use Magento\Customer\Model\Session;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class BargainPriceObserver implements ObserverInterface
{
    protected Session $customerSession;
    private \Magento\Framework\DB\Adapter\AdapterInterface $connection;

    public function __construct(Session $customerSession)
    {
        $resources        = ObjectManager::getInstance()->get('Magento\Framework\App\ResourceConnection');
        $this->connection = $resources->getConnection();

        $this->customerSession = $customerSession;
    }

    public function execute(Observer $observer)
    {
        $item = $observer->getEvent()->getData('quote_item');
        $item = ($item->getParentItem() ? $item->getParentItem() : $item);

        $today      = date('Y-m-d');
        $product   = $item->getProduct();
        $startDate  = $product->getCustomAttribute('bargain_start_date') ? $product->getCustomAttribute('bargain_start_date')->getValue() : $today;
        $endDate    = $product->getCustomAttribute('bargain_end_date') ? $product->getCustomAttribute('bargain_end_date')->getValue() : $today;


        if (strtotime($today) >= strtotime($startDate) && strtotime($today) <= strtotime($endDate)) {
            $allowed = true;
        } else {
            $allowed = false;
        }

        if ($allowed) {
            $sessionId = $this->customerSession->getSessionId();
            $sql       = 'SELECT * FROM `bargain` WHERE `product_id` = ? AND session_id = ? AND `finalized_price` > 0 ORDER BY responded_at DESC LIMIT 1';
            $row       = $this->connection->fetchRow($sql, [$item['sku'], $sessionId]);
            if ($row) {
                $price = $row['finalized_price'];
                $item->setCustomPrice($price);
                $item->setOriginalCustomPrice($price);
                $item->getProduct()->setIsSuperMode(true);
            }
        }
    }
}
