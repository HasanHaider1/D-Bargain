<?php

namespace DBargain\DBargain\Model\ResourceModel\BargainMessageModel;

use DBargain\DBargain\Model\BargainMessageModel;
use DBargain\DBargain\Model\ResourceModel\BargainMessageResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class BargainMessageCollection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'bargain_message_collection';

    /**
     * Initialize collection model.
     */
    protected function _construct()
    {
        $this->_init(BargainMessageModel::class, BargainMessageResource::class);
    }
}
