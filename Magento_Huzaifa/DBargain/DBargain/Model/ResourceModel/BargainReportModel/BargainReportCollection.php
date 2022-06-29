<?php

namespace DBargain\DBargain\Model\ResourceModel\BargainReportModel;

use DBargain\DBargain\Model\BargainReportModel;
use DBargain\DBargain\Model\ResourceModel\BargainReportResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class BargainReportCollection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'bargain_report_collection';

    /**
     * Initialize collection model.
     */
    protected function _construct()
    {
        $this->_init(BargainReportModel::class, BargainReportResource::class);
    }
}
