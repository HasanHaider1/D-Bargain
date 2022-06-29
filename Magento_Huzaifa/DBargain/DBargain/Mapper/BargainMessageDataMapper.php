<?php

namespace DBargain\DBargain\Mapper;

use DBargain\DBargain\Api\Data\BargainMessageInterface;
use DBargain\DBargain\Api\Data\BargainMessageInterfaceFactory;
use DBargain\DBargain\Model\BargainMessageModel;
use Magento\Framework\DataObject;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Converts a collection of BargainMessage entities to an array of data transfer objects.
 */
class BargainMessageDataMapper
{
    /**
     * @var BargainMessageInterfaceFactory
     */
    private $entityDtoFactory;

    /**
     * @param  BargainMessageInterfaceFactory  $entityDtoFactory
     */
    public function __construct(
        BargainMessageInterfaceFactory $entityDtoFactory
    ) {
        $this->entityDtoFactory = $entityDtoFactory;
    }

    /**
     * Map magento models to DTO array.
     *
     * @param  AbstractCollection  $collection
     *
     * @return array|BargainMessageInterface[]
     */
    public function map(AbstractCollection $collection): array
    {
        $results = [];
        /** @var BargainMessageModel $item */
        foreach ($collection->getItems() as $item) {
            /** @var BargainMessageInterface|DataObject $entityDto */
            $entityDto = $this->entityDtoFactory->create();
            $entityDto->addData($item->getData());

            $results[] = $entityDto;
        }

        return $results;
    }
}
