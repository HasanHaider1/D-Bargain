<?php

namespace DBargain\DBargain\Setup;

use Magento\Catalog\Model\Attribute\Backend\Startdate;
use Magento\Eav\Model\Entity\Attribute\Backend\Datetime;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;

    public function __construct(
        EavSetupFactory $eavSetupFactory
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'bargain_threshold');
        $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'bargain_start_date');
        $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'bargain_end_date');

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'bargain_threshold',
            [
                'type'       => 'decimal',
                'input'      => 'price',
                'label'      => 'Bargain Threshold',
                'required'   => false,
                'sort_order' => 10,
                'backend'    => \Magento\Catalog\Model\Product\Attribute\Backend\Price::class,
                'global'     => ScopedAttributeInterface::SCOPE_STORE,
                'group'      => 'General',
            ]
        );

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'bargain_start_date',
            [
                'type' => 'datetime',
                'label' => 'Bargain Allowed From Date',
                'input' => 'date',
                'backend' => Startdate::class,
                'required' => false,
                'sort_order' => 11,
                'global' => ScopedAttributeInterface::SCOPE_WEBSITE
            ],
        );

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'bargain_end_date',
            [
                'type' => 'datetime',
                'label' => 'Bargain Allowed To Date',
                'input' => 'date',
                'backend' => Datetime::class,
                'required' => false,
                'sort_order' => 12,
                'global' => ScopedAttributeInterface::SCOPE_WEBSITE
            ],
        );
    }
}
