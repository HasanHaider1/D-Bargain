<?php

namespace DBargain\DBargain\Model\ResourceModel\BargainModel;

use DBargain\DBargain\Model\BargainModel;
use DBargain\DBargain\Model\ResourceModel\BargainResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class BargainCollection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'bargain_collection';

    /**
     * Initialize collection model.
     */
    protected function _construct()
    {
        $this->_init(BargainModel::class, BargainResource::class);
    }
}
