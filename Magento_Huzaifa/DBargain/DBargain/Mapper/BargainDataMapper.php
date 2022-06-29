<?php

namespace DBargain\DBargain\Mapper;

use DBargain\DBargain\Api\Data\BargainInterface;
use DBargain\DBargain\Api\Data\BargainInterfaceFactory;
use DBargain\DBargain\Model\BargainModel;
use Magento\Framework\DataObject;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Converts a collection of Bargain entities to an array of data transfer objects.
 */
class BargainDataMapper
{
    /**
     * @var BargainInterfaceFactory
     */
    private $entityDtoFactory;

    /**
     * @param  BargainInterfaceFactory  $entityDtoFactory
     */
    public function __construct(
        BargainInterfaceFactory $entityDtoFactory
    ) {
        $this->entityDtoFactory = $entityDtoFactory;
    }

    /**
     * Map magento models to DTO array.
     *
     * @param  AbstractCollection  $collection
     *
     * @return array|BargainInterface[]
     */
    public function map(AbstractCollection $collection): array
    {
        $results = [];
        /** @var BargainModel $item */
        foreach ($collection->getItems() as $item) {
            /** @var BargainInterface|DataObject $entityDto */
            $entityDto = $this->entityDtoFactory->create();
            $entityDto->addData($item->getData());

            $results[] = $entityDto;
        }

        return $results;
    }
}
