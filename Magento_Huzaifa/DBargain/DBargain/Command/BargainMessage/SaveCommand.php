<?php

namespace DBargain\DBargain\Command\BargainMessage;

use DBargain\DBargain\Api\Data\BargainMessageInterface;
use DBargain\DBargain\Model\BargainMessageModel;
use DBargain\DBargain\Model\BargainMessageModelFactory;
use DBargain\DBargain\Model\ResourceModel\BargainMessageResource;
use Exception;
use Magento\Framework\Exception\CouldNotSaveException;
use Psr\Log\LoggerInterface;

/**
 * Save BargainMessage Command.
 */
class SaveCommand
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var BargainMessageModelFactory
     */
    private $modelFactory;

    /**
     * @var BargainMessageResource
     */
    private $resource;

    /**
     * @param  LoggerInterface  $logger
     * @param  BargainMessageModelFactory  $modelFactory
     * @param  BargainMessageResource  $resource
     */
    public function __construct(
        LoggerInterface $logger,
        BargainMessageModelFactory $modelFactory,
        BargainMessageResource $resource
    ) {
        $this->logger       = $logger;
        $this->modelFactory = $modelFactory;
        $this->resource     = $resource;
    }

    /**
     * Save BargainMessage.
     *
     * @param  BargainMessageInterface  $bargainMessage
     *
     * @return int
     * @throws CouldNotSaveException
     */
    public function execute(BargainMessageInterface $bargainMessage): int
    {
        try {
            /** @var BargainMessageModel $model */
            $model = $this->modelFactory->create();
            $model->addData($bargainMessage->getData());
            $model->setHasDataChanges(true);

            if ( ! $model->getData(BargainMessageInterface::BARGAIN_MESSAGE_ID)) {
                $model->isObjectNew(true);
            }
            $this->resource->save($model);
        } catch (Exception $exception) {
            $this->logger->error(
                __('Could not save BargainMessage. Original message: {message}'),
                [
                    'message'   => $exception->getMessage(),
                    'exception' => $exception
                ]
            );
            throw new CouldNotSaveException(__('Could not save BargainMessage.'));
        }

        return (int) $model->getData(BargainMessageInterface::BARGAIN_MESSAGE_ID);
    }
}
