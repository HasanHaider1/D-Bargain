<?php

namespace DBargain\DBargain\Query\BargainReport;

use DBargain\DBargain\Mapper\BargainReportDataMapper;
use DBargain\DBargain\Model\ResourceModel\BargainReportModel\BargainReportCollection;
use DBargain\DBargain\Model\ResourceModel\BargainReportModel\BargainReportCollectionFactory;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;

/**
 * Get BargainReport list by search criteria query.
 */
class GetListQuery
{
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var BargainReportCollectionFactory
     */
    private $entityCollectionFactory;

    /**
     * @var BargainReportDataMapper
     */
    private $entityDataMapper;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var SearchResultsInterfaceFactory
     */
    private $searchResultFactory;

    /**
     * @param  CollectionProcessorInterface  $collectionProcessor
     * @param  BargainReportCollectionFactory  $entityCollectionFactory
     * @param  BargainReportDataMapper  $entityDataMapper
     * @param  SearchCriteriaBuilder  $searchCriteriaBuilder
     * @param  SearchResultsInterfaceFactory  $searchResultFactory
     */
    public function __construct(
        CollectionProcessorInterface $collectionProcessor,
        BargainReportCollectionFactory $entityCollectionFactory,
        BargainReportDataMapper $entityDataMapper,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SearchResultsInterfaceFactory $searchResultFactory
    ) {
        $this->collectionProcessor     = $collectionProcessor;
        $this->entityCollectionFactory = $entityCollectionFactory;
        $this->entityDataMapper        = $entityDataMapper;
        $this->searchCriteriaBuilder   = $searchCriteriaBuilder;
        $this->searchResultFactory     = $searchResultFactory;
    }

    /**
     * Get BargainReport list by search criteria.
     *
     * @param  SearchCriteriaInterface|null  $searchCriteria
     *
     * @return SearchResultsInterface
     */
    public function execute(?SearchCriteriaInterface $searchCriteria = null): SearchResultsInterface
    {
        /** @var BargainReportCollection $collection */
        $collection = $this->entityCollectionFactory->create();

        if ($searchCriteria === null) {
            $searchCriteria = $this->searchCriteriaBuilder->create();
        } else {
            $this->collectionProcessor->process($searchCriteria, $collection);
        }

        $entityDataObjects = $this->entityDataMapper->map($collection);

        /** @var SearchResultsInterface $searchResult */
        $searchResult = $this->searchResultFactory->create();
        $searchResult->setItems($entityDataObjects);
        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setSearchCriteria($searchCriteria);

        return $searchResult;
    }
}
