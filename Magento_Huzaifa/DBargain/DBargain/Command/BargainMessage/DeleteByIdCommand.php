<?php

namespace DBargain\DBargain\Command\BargainMessage;

use DBargain\DBargain\Api\Data\BargainMessageInterface;
use DBargain\DBargain\Model\BargainMessageModel;
use DBargain\DBargain\Model\BargainMessageModelFactory;
use DBargain\DBargain\Model\ResourceModel\BargainMessageResource;
use Exception;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Psr\Log\LoggerInterface;

/**
 * Delete BargainMessage by id Command.
 */
class DeleteByIdCommand
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
     * Delete BargainMessage.
     *
     * @param  int  $entityId
     *
     * @return void
     * @throws CouldNotDeleteException
     */
    public function execute(int $entityId): void
    {
        try {
            /** @var BargainMessageModel $model */
            $model = $this->modelFactory->create();
            $this->resource->load($model, $entityId, BargainMessageInterface::BARGAIN_MESSAGE_ID);

            if ( ! $model->getData(BargainMessageInterface::BARGAIN_MESSAGE_ID)) {
                throw new NoSuchEntityException(
                    __('Could not find BargainMessage with id: `%id`',
                        [
                            'id' => $entityId
                        ]
                    )
                );
            }

            $this->resource->delete($model);
        } catch (Exception $exception) {
            $this->logger->error(
                __('Could not delete BargainMessage. Original message: {message}'),
                [
                    'message'   => $exception->getMessage(),
                    'exception' => $exception
                ]
            );
            throw new CouldNotDeleteException(__('Could not delete BargainMessage.'));
        }
    }
}
