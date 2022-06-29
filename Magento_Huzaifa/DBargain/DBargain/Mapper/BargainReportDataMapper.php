<?php

namespace DBargain\DBargain\Mapper;

use DBargain\DBargain\Model\BargainReportModel;
use DBargain\DBargain\Model\Data\BargainReportData;
use DBargain\DBargain\Model\Data\BargainReportDataFactory;
use Magento\Framework\DataObject;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Converts a collection of BargainReport entities to an array of data transfer objects.
 */
class BargainReportDataMapper
{
    /**
     * @var BargainReportDataFactory
     */
    private $entityDtoFactory;

    /**
     * @param  BargainReportDataFactory  $entityDtoFactory
     */
    public function __construct(
        BargainReportDataFactory $entityDtoFactory
    ) {
        $this->entityDtoFactory = $entityDtoFactory;
    }

    /**
     * Map magento models to DTO array.
     *
     * @param  AbstractCollection  $collection
     *
     * @return array|BargainReportData[]
     */
    public function map(AbstractCollection $collection): array
    {
        $results = [];
        /** @var BargainReportModel $item */
        foreach ($collection->getItems() as $item) {
            /** @var BargainReportData|DataObject $entityDto */
            $entityDto = $this->entityDtoFactory->create();
            $entityDto->addData($item->getData());

            $results[] = $entityDto;
        }

        return $results;
    }
}
