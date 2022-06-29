<?php

namespace DBargain\DBargain\Model;

use DBargain\DBargain\Model\ResourceModel\BargainMessageResource;
use Magento\Framework\Model\AbstractModel;

class BargainMessageModel extends AbstractModel
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'bargain_message_model';

    /**
     * Initialize magento model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(BargainMessageResource::class);
    }
}
