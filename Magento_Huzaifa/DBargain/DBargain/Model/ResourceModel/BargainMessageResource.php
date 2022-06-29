<?php

namespace DBargain\DBargain\Model\ResourceModel;

use DBargain\DBargain\Api\Data\BargainMessageInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class BargainMessageResource extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'bargain_message_resource_model';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('bargain_message', BargainMessageInterface::BARGAIN_MESSAGE_ID);
        $this->_useIsObjectNew = true;
    }
}
