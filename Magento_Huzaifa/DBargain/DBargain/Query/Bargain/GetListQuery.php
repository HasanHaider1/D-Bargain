<?php

namespace DBargain\DBargain\Query\Bargain;

use DBargain\DBargain\Mapper\BargainDataMapper;
use DBargain\DBargain\Model\ResourceModel\BargainModel\BargainCollection;
use DBargain\DBargain\Model\ResourceModel\BargainModel\BargainCollectionFactory;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;

/**
 * Get Bargain list by search criteria query.
 */
class GetListQuery
{
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var BargainCollectionFactory
     */
    private $entityCollectionFactory;

    /**
     * @var BargainDataMapper
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
     * @param  BargainCollectionFactory  $entityCollectionFactory
     * @param  BargainDataMapper  $entityDataMapper
     * @param  SearchCriteriaBuilder  $searchCriteriaBuilder
     * @param  SearchResultsInterfaceFactory  $searchResultFactory
     */
    public function __construct(
        CollectionProcessorInterface $collectionProcessor,
        BargainCollectionFactory $entityCollectionFactory,
        BargainDataMapper $entityDataMapper,
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
     * Get Bargain list by search criteria.
     *
     * @param  SearchCriteriaInterface|null  $searchCriteria
     *
     * @return SearchResultsInterface
     */
    public function execute(?SearchCriteriaInterface $searchCriteria = null): SearchResultsInterface
    {
        /** @var BargainCollection $collection */
        $collection = $this->entityCollectionFactory->create();

//        $attr = $this->getAttributeIdofProductName();
//        $collection->getSelect()->group('product_id');

//        echo $collection->getSelect(); die;
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

    private function getAttributeIdofProductName()
    {
        $om = \Magento\Framework\App\ObjectManager::getInstance();
        /** @var \Magento\Store\Model\StoreManagerInterface $manager */
        $attr                   = $om->get('\Magento\Eav\Api\AttributeRepositoryInterface');
        $productNameAttributeId = $attr->get('catalog_product', 'name')->getId();

        return $productNameAttributeId;
    }
}
