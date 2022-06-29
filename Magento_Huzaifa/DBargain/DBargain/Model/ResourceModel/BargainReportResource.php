<?php

namespace DBargain\DBargain\Model\ResourceModel;

use DBargain\DBargain\Model\Data\BargainReportData;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class BargainReportResource extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'bargain_report_resource_model';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('bargain_report', BargainReportData::BARGAIN_REPORT_ID);
        $this->_useIsObjectNew = true;
    }
}
