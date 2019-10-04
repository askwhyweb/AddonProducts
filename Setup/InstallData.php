<?php

namespace OrviSoft\AddonProducts\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
 
/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{
    /**
     * EAV setup factory
     *
     * @var EavSetupFactory
     */
    private $eavSetupFactory;
 
    /**
     * Init
     *
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }
 
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        if (version_compare($context->getVersion(), '1.0.0') < 0){

			$eavSetup->removeAttribute(\Magento\Catalog\Model\Category::ENTITY, 'addon_accessories_id');

            $eavSetup->addAttribute(
                    \Magento\Catalog\Model\Category::ENTITY,
                    'addon_accessories_id',
                    [
                        'type' => 'int',
                        'label' => 'Addon Accessories',
                        'input' => 'select',
                        'sort_order' => 110,
                        'source' => 'OrviSoft\AddonProducts\Model\Category\Attribute\Source\AddonAccessoriesId',
                        'global' => 1,
                        'visible' => true,
                        'required' => false,
                        'user_defined' => false,
                        'default' => 0,
                        'group' => 'General Information',
                        'backend' => ''
                    ]
                );
            
            $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'addon_accessories');
            
            $eavSetup->addAttribute(
                    \Magento\Catalog\Model\Product::ENTITY,
                    'addon_accessories',
                    [
                        'type' => 'int',
                        'label' => 'Addon Accessories',
                        'input' => 'select',
                        'source' => \OrviSoft\AddonProducts\Model\Product\Attribute\Source\AddonAccessories::class,
                        'frontend' => '',
                        'required' => false,
                        'backend' => '',
                        'sort_order' => '30',
                        'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                        'default' => 0,
                        'visible' => true,
                        'user_defined' => false,
                        'searchable' => false,
                        'filterable' => false,
                        'comparable' => false,
                        'visible_on_front' => false,
                        'unique' => false,
                        'apply_to' => '',
                        'group' => 'General',
                        'used_in_product_listing' => false,
                        'is_used_in_grid' => true,
                        'is_visible_in_grid' => false,
                        'is_filterable_in_grid' => false,
                        'option' => ''
                    ]
                );

            $table = $setup->getConnection()
                ->newTable($setup->getTable('addon_accessories'))
                ->addColumn(
                    'id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                    'Addon ID'
                )
                ->addColumn(
                    'label',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable' => false, 'default' => ''],
                    'Label'
                )
                ->addColumn(
                    'title_1',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable' => false, 'default' => ''],
                    'Title 1'
                )
                ->addColumn(
                    'products_1',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '64k',
                    ['nullable' => false, 'default' => ''],
                    'Products 1'
                )
                ->addColumn(
                    'title_2',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable' => false, 'default' => ''],
                    'Title 2'
                )
                ->addColumn(
                    'products_2',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '64k',
                    ['nullable' => false, 'default' => ''],
                    'Products 2'
                )
                ->addColumn(
                    'title_3',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable' => false, 'default' => ''],
                    'Title 3'
                )
                ->addColumn(
                    'products_3',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '64k',
                    ['nullable' => false, 'default' => ''],
                    'Products 3'
                )
                ->addColumn(
					'is_active',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					1,
					[],
					'Post Status'
				)
                ->setComment("Addon Accessories table");
            $setup->getConnection()->createTable($table);

        }
		

    }
}
