<?php

namespace DBargain\DBargain\Block;

use Magento\Framework\View\Element\Template;

class Index extends Template
{
    protected \Magento\Catalog\Model\ProductRepository $productRepository;

    public function __construct(
        Template\Context $context,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->productRepository = $productRepository;
    }

    public function getProductById($id)
    {
        return $this->productRepository->getById($id);
    }

    public function getProductBySku($sku)
    {
        return $this->productRepository->get($sku);
    }
}
