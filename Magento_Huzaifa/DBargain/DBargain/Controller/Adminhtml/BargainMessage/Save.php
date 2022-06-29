<?php

namespace DBargain\DBargain\Controller\Adminhtml\BargainMessage;

use DBargain\DBargain\Api\Data\BargainMessageInterface;
use DBargain\DBargain\Api\Data\BargainMessageInterfaceFactory;
use DBargain\DBargain\Command\BargainMessage\SaveCommand;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\CouldNotSaveException;

/**
 * Save BargainMessage controller action.
 */
class Save extends Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'DBargain_DBargain::management';

    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var SaveCommand
     */
    private $saveCommand;

    /**
     * @var BargainMessageInterfaceFactory
     */
    private $entityDataFactory;

    /**
     * @param  Context  $context
     * @param  DataPersistorInterface  $dataPersistor
     * @param  SaveCommand  $saveCommand
     * @param  BargainMessageInterfaceFactory  $entityDataFactory
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        SaveCommand $saveCommand,
        BargainMessageInterfaceFactory $entityDataFactory
    ) {
        parent::__construct($context);
        $this->dataPersistor     = $dataPersistor;
        $this->saveCommand       = $saveCommand;
        $this->entityDataFactory = $entityDataFactory;
    }

    /**
     * Save BargainMessage Action.
     *
     * @return ResponseInterface|ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $params         = $this->getRequest()->getParams();

        try {
            /** @var BargainMessageInterface|DataObject $entityModel */
            $entityModel = $this->entityDataFactory->create();
            $entityModel->addData($params['general']);
            $this->saveCommand->execute($entityModel);
            $this->messageManager->addSuccessMessage(
                __('The BargainMessage data was saved successfully')
            );
            $this->dataPersistor->clear('entity');
        } catch (CouldNotSaveException $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
            $this->dataPersistor->set('entity', $params);

            return $resultRedirect->setPath('*/*/edit', [
                BargainMessageInterface::BARGAIN_MESSAGE_ID => $this->getRequest()->getParam(BargainMessageInterface::BARGAIN_MESSAGE_ID)
            ]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}
