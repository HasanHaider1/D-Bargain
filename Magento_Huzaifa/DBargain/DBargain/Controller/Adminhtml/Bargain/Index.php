<?php

namespace DBargain\DBargain\Controller\Adminhtml\Bargain;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * Bargain backend index (list) controller.
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

        $resultPage->setActiveMenu('DBargain_DBargain::management');
        $resultPage->addBreadcrumb(__('Bargain'), __('Bargain'));
        $resultPage->addBreadcrumb(__('Manage Bargains'), __('Manage Bargains'));
        $resultPage->getConfig()->getTitle()->prepend(__('Bargain Detail'));

        return $resultPage;
    }
}
