<?php

namespace DBargain\DBargain\Controller\Adminhtml\BargainMessage;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * Edit BargainMessage entity backend controller.
 */
class Edit extends Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session.
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'DBargain_DBargain::management';

    /**
     * Edit BargainMessage action.
     *
     * @return Page|ResultInterface
     */
    public function execute()
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('DBargain_DBargain::management');
        $resultPage->getConfig()->getTitle()->prepend(__('Edit BargainMessage'));

        return $resultPage;
    }
}
