<?php declare(strict_types=1);


namespace DBargain\DBargain\Helper;


use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    const XML_PATH = 'dbargainconfig/';

    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(self::XML_PATH . $field, ScopeInterface::SCOPE_STORE, $storeId);
    }
}
