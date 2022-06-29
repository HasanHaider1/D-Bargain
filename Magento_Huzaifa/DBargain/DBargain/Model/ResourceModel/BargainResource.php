<?php

namespace DBargain\DBargain\Model\ResourceModel;

use DBargain\DBargain\Api\Data\BargainInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class BargainResource extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'bargain_resource_model';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('bargain', BargainInterface::BARGAIN_ID);
        $this->_useIsObjectNew = true;
    }
}
