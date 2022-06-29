<?php

namespace DBargain\DBargain\Controller\Adminhtml\BargainReport;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * BargainReport backend index (list) controller.
 */
class Index extends Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session.
     */
    const ADMIN_RESOURCE = 'DBargain_DBargain::management';

    /**
     * Execute action based on request and return result.
     *
     * @return ResultInterface|ResponseInterface
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $resultPage->setActiveMenu('DBargain_DBargain::report');
        $resultPage->addBreadcrumb(__('Bargain Report'), __('Bargain Report'));
        $resultPage->addBreadcrumb(__('Manage Bargain Reports'), __('Manage Bargain Reports'));
        $resultPage->getConfig()->getTitle()->prepend(__('Bargain Report'));

        return $resultPage;
    }
}
