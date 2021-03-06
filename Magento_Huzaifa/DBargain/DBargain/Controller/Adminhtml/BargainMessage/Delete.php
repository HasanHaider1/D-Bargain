<?php

namespace DBargain\DBargain\Controller\Adminhtml\BargainMessage;

use DBargain\DBargain\Api\Data\BargainMessageInterface;
use DBargain\DBargain\Command\BargainMessage\DeleteByIdCommand;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Delete BargainMessage controller.
 */
class Delete extends Action implements HttpPostActionInterface, HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session.
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'DBargain_DBargain::management';

    /**
     * @var DeleteByIdCommand
     */
    private $deleteByIdCommand;

    /**
     * @param  Context  $context
     * @param  DeleteByIdCommand  $deleteByIdCommand
     */
    public function __construct(
        Context $context,
        DeleteByIdCommand $deleteByIdCommand
    ) {
        parent::__construct($context);
        $this->deleteByIdCommand = $deleteByIdCommand;
    }

    /**
     * Delete BargainMessage action.
     *
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var ResultInterface $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('*/*/');
        $entityId = (int) $this->getRequest()->getParam(BargainMessageInterface::BARGAIN_MESSAGE_ID);

        try {
            $this->deleteByIdCommand->execute($entityId);
            $this->messageManager->addSuccessMessage(__('You have successfully deleted BargainMessage entity'));
        } catch (CouldNotDeleteException | NoSuchEntityException $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
        }

        return $resultRedirect;
    }
}
