<?php

namespace DBargain\DBargain\Model;

use DBargain\DBargain\Model\ResourceModel\BargainResource;
use Magento\Framework\Model\AbstractModel;

class BargainModel extends AbstractModel
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'bargain_model';

    /**
     * Initialize magento model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(BargainResource::class);
    }
}
