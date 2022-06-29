<?php

namespace DBargain\DBargain\Controller\Index;

use DBargain\DBargain\Helper\Data;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var JsonFactory
     */
    protected $resultJsonFactory;
    protected Session $customerSession;
    protected \Magento\User\Model\UserFactory $userFactory;
    protected \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig;
    protected $connection;
    protected Data $helper;
    protected \Magento\Catalog\Model\ProductRepository $productRepository;
    /** @var \Magento\Framework\App\ResourceConnection|mixed */
    private $_resources;

    /**
     * @param  Context  $context
     * @param  PageFactory  $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        \Magento\User\Model\UserFactory $userFactory,
        JsonFactory $resultJsonFactory,
        Session $customerSession,
        Data $helper,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Catalog\Model\ProductRepository $productRepository
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->customerSession   = $customerSession;

        $this->_resources  = ObjectManager::getInstance()->get('Magento\Framework\App\ResourceConnection');
        $this->connection  = $this->_resources->getConnection();
        $this->userFactory = $userFactory;
        $this->scopeConfig = $scopeConfig;

        $this->helper            = $helper;
        $this->productRepository = $productRepository;

        return parent::__construct($context);

    }

    public function execute()
    {
        if ( ! isset($_SESSION['attempt_number'])) {
            $lowerRange                 = $this->helper->getConfigValue('config_ranges/lower_range') ?: 1;
            $upperRange                 = $this->helper->getConfigValue('config_ranges/upper_range') ?: 5;
            $attempts                   = rand($lowerRange, $upperRange);
            $_SESSION['attempts']       = $attempts;
            $_SESSION['attempt_number'] = 0;
        }

        $user         = $this->userFactory->create()->loadByUsername('admin');
        $sessionId    = $this->customerSession->getSessionId();
        $customer = $this->customerSession->getCustomer();
        $customerId   = $customer->getId();
        $bargainPrice = $this->getRequest()->getParam('price', -1);
        $productId    = $this->getRequest()->getParam('productId');

        $product      = $this->getProductBySku($productId);
        $productPrice = $product->getPrice();
        $threshold    = $product->getCustomAttribute('bargain_threshold') ? $product->getCustomAttribute('bargain_threshold')->getValue() : $productPrice;

        // TODO: use the difference of threshold for further logic.
        // $diff = $productPrice / $threshold;

        $userId         = $user->getId();
        $result         = $this->resultJsonFactory->create();
        $resultPage     = $this->resultPageFactory->create();
        $finalizedPrice = 0;
        $end            = false;

        $sql = 'SELECT * FROM `bargain` WHERE `product_id` = ? AND session_id = ? AND `finalized_price` != 0 AND order_id IS NULL ORDER BY responded_at DESC LIMIT 1';
        $row = $this->connection->fetchRow($sql, [$product->getSku(), $sessionId]);

        if ( ! $row) {
            if ($bargainPrice === -1) {
                $sql = 'SELECT * FROM `bargain` WHERE `product_id` = ? AND session_id = ? AND order_id IS NULL ORDER BY responded_at DESC LIMIT 1';
                $row = $this->connection->fetchRow($sql, [$product->getSku(), $sessionId]);
                if ( ! $row) {
                    $message = $this->connection->fetchRow("SELECT * FROM bargain_message WHERE attempt = 0");
                    $content = str_replace(['{product}', '{price}'], [$product->getName(), $bargainPrice],
                        $message['content']);
                    $sql     = "INSERT INTO bargain (session_id, product_id, product_name, user_id, customer_id, customer_name, admin_response, current_price, responded_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";
                    $this->connection->query($sql,
                        [$sessionId, $productId, $product->getName(), $userId, $customerId, $customer->getName(), $content, $productPrice]);
                }
            } else {
                // force a delay to make it look more realistic.
                \sleep(3);
                // increase attempt count
                $_SESSION['attempt_number']++;

                if ($bargainPrice >= $threshold && $bargainPrice <= $productPrice) {
                    $message = $this->connection->fetchRow("SELECT * FROM bargain_message WHERE message_type = 'success' AND is_final = 1 ORDER BY RAND() LIMIT 1");
                    $content = str_replace(['{product}', '{price}'], [$product->getName(), $bargainPrice],
                        $message['content']);
                    unset($_SESSION['attempt_number']);
                    $_SESSION['attempts'] = -1;
                    $end                  = true;
                    $finalizedPrice       = $bargainPrice;
                    $sql                  = "INSERT INTO bargain (session_id, product_id, product_name, user_id, customer_id, customer_name, admin_response, bargained_price, finalized_price, current_price, responded_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
                    $this->connection->query($sql,
                        [
                            $sessionId, $productId, $product->getName(), $userId, $customerId, $customer->getName(), $content, $bargainPrice, $finalizedPrice, $productPrice
                        ]);

                } else {
                    if ($bargainPrice < $threshold) {
                        $message = $this->connection->fetchRow("SELECT * FROM bargain_message WHERE message_type = 'low' ORDER BY RAND() LIMIT 1");
                        $content = str_replace(['{product}', '{price}'], [$product->getName(), $bargainPrice],
                            $message['content']);

                    } else {
                        $message = $this->connection->fetchRow("SELECT * FROM bargain_message WHERE message_type = 'high' ORDER BY RAND() LIMIT 1");
                        $content = str_replace(['{product}', '{price}'], [$product->getName(), $bargainPrice],
                            $message['content']);
                    }

                    if ($_SESSION['attempts'] === $_SESSION['attempt_number'] + 1) {
                        $message = $this->connection->fetchRow("SELECT * FROM bargain_message WHERE is_warning = 1 ORDER BY RAND() LIMIT 1");
                        $content = str_replace(['{product}', '{price}'], [$product->getName(), $bargainPrice],
                            $message['content']);
                    }

                    if ($_SESSION['attempts'] === $_SESSION['attempt_number']) {
                        $end     = true;
                        $message = $this->connection->fetchRow("SELECT * FROM bargain_message WHERE message_type = 'fail' AND is_final = 1 ORDER BY RAND() LIMIT 1");
                        $content = str_replace(['{product}', '{price}'], [$product->getName(), $bargainPrice],
                            $message['content']);
                        // take an average if we cannot come up to a mutual bargain price
                        $finalizedPrice = (int) ($product->getPrice() + $threshold) / 2;
                    }

                    $sql = "INSERT INTO bargain (session_id, product_id, product_name, user_id, customer_id, customer_name, admin_response, bargained_price, finalized_price, current_price, responded_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
                    $this->connection->query($sql,
                        [
                            $sessionId, $productId, $product->getName(), $userId, $customerId, $customer->getName(), $content, $bargainPrice, $finalizedPrice, $productPrice
                        ]);
                }
            }
        }

        // History
        $messages = [];
        $sql      = 'SELECT * from bargain where session_id = ? AND product_id = ? AND order_id IS NULL ORDER BY responded_at';
        $rows     = $this->connection->fetchAll($sql, [$sessionId, $productId]);
        foreach ($rows as $row) {
            if ($row['bargained_price'] !== null) {
                $messages[] = [
                    'user' => $row['bargained_price']
                ];
            }

            if ($row['admin_response']) {
                $messages[] = [
                    'admin' => $row['admin_response']
                ];
            }
        }

        $data = [
            'productId'    => $productId,
            'username'     => $user->getFirstName().' '.$user->getLastName(),
            'response'     => $messages,
            'bargainPrice' => $bargainPrice
        ];

        $block = $resultPage
            ->getLayout()
            ->createBlock('DBargain\DBargain\Block\Index')
            ->setTemplate('DBargain_DBargain::bargain_result.phtml')
            ->setData('data', $data)
            ->toHtml();


        $result->setData([
            'output' => $block,
            'end'    => $end
        ]);

        return $result;
    }

    public function getProductBySku($sku)
    {
        return $this->productRepository->get($sku);
    }
}
