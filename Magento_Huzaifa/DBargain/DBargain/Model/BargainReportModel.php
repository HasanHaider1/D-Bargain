<?php

namespace DBargain\DBargain\Model;

use DBargain\DBargain\Model\ResourceModel\BargainReportResource;
use Magento\Framework\Model\AbstractModel;

class BargainReportModel extends AbstractModel
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'bargain_report_model';

    /**
     * Initialize magento model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(BargainReportResource::class);
    }
}
