<?php declare(strict_types=1);


namespace DBargain\DBargain\Observer;

use Magento\Customer\Model\Session;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Event\ObserverInterface;

class OrderSaveObserver implements ObserverInterface
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
        $order = $observer->getEvent()->getOrder();
        $sql   = 'UPDATE `bargain` SET order_id = ? WHERE session_id = ? AND order_id IS NULL';
        $this->connection->query($sql, [$order->getId(), $this->customerSession->getSessionId()]);

        $sql  = 'SELECT * FROM bargain WHERE order_id = ? AND finalized_price > 0';
        $rows = $this->connection->fetchAll($sql, [$order->getId()]);
        print_r($rows); exit;
        if ($rows) {
            foreach ($rows as $row) {
                $sql    = 'SELECT * FROM bargain_report WHERE product_id = ?';
                $report = $this->connection->fetchRow($sql, [$row['product_id']]);

                $sql  = 'SELECT count(*) as buys FROM bargain WHERE product_id = ? and customer_id IS NOT NULL and finalized_price > 0 GROUP BY customer_id';
                $buys = $this->connection->fetchRow($sql, [$row['product_id']]);
                if ( ! $buys) {
                    $buys['buys'] = 0;
                }

                if ($report) {
                    $sql = 'UPDATE bargain_report SET times_purchased = times_purchased + 1, no_of_buyers = ? + 1 WHERE product_id = ?';
                    $this->connection->query($sql, [$buys['buys'], $row['product_id']]);
                } else {
                    $sql = 'INSERT INTO bargain_report (times_purchased, no_of_buyers, product_id ) VALUES(1, 1, ?)';
                    $this->connection->query($sql, [$row['product_id']]);
                }
            }
        }

    }
}
