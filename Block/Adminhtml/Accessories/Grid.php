<?php
namespace OrviSoft\AddonProducts\Block\Adminhtml\Accessories;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @var \OrviSoft\AddonProducts\Model\accessoriesFactory
     */
    protected $_accessoriesFactory;

    /**
     * @var \OrviSoft\AddonProducts\Model\Status
     */
    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \OrviSoft\AddonProducts\Model\accessoriesFactory $accessoriesFactory
     * @param \OrviSoft\AddonProducts\Model\Status $status
     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param array $data
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \OrviSoft\AddonProducts\Model\AccessoriesFactory $AccessoriesFactory,
        \OrviSoft\AddonProducts\Model\Status $status,
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    ) {
        $this->_accessoriesFactory = $AccessoriesFactory;
        $this->_status = $status;
        $this->moduleManager = $moduleManager;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('postGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(false);
        $this->setVarNameFilter('post_filter');
    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = $this->_accessoriesFactory->create()->getCollection();
        $this->setCollection($collection);

        parent::_prepareCollection();

        return $this;
    }

    /**
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id'
            ]
        );

                $this->addColumn(
					'label',
					[
						'header' => __('Label'),
						'index' => 'label',
					]
				);
				
				$this->addColumn(
					'title_1',
					[
						'header' => __('Title 1'),
						'index' => 'title_1',
					]
				);
				
				$this->addColumn(
					'title_2',
					[
						'header' => __('Title 2'),
						'index' => 'title_2',
					]
				);
				
				$this->addColumn(
					'title_3',
					[
						'header' => __('Title 3'),
						'index' => 'title_3',
					]
				);
				
						
                $this->addColumn(
                    'is_active',
                    [
                        'header' => __('Status'),
                        'index' => 'is_active',
                        'type' => 'options',
                        'options' => \OrviSoft\AddonProducts\Block\Adminhtml\Accessories\Grid::getOptionArray14()
                    ]
                );
						
						


		
        $this->addColumn(
            'edit',
            [
                'header' => __('Edit'),
                'type' => 'action',
                'getter' => 'getId',
                'actions' => [
                    [
                        'caption' => __('Edit'),
                        'url' => [
                            'base' => '*/*/edit'
                        ],
                        'field' => 'id'
                    ]
                ],
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'header_css_class' => 'col-action',
                'column_css_class' => 'col-action'
            ]
        );
		

		
		   $this->addExportType($this->getUrl('addonproducts/*/exportCsv', ['_current' => true]),__('CSV'));
		   $this->addExportType($this->getUrl('addonproducts/*/exportExcel', ['_current' => true]),__('Excel XML'));

        $block = $this->getLayout()->getBlock('grid.bottom.links');
        if ($block) {
            $this->setChild('grid.bottom.links', $block);
        }

        return parent::_prepareColumns();
    }

	
    /**
     * @return $this
     */
    protected function _prepareMassaction()
    {

        $this->setMassactionIdField('id');
        //$this->getMassactionBlock()->setTemplate('OrviSoft_AddonProducts::accessories/grid/massaction_extended.phtml');
        $this->getMassactionBlock()->setFormFieldName('accessories');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('addonproducts/*/massDelete'),
                'confirm' => __('Are you sure?')
            ]
        );

        $statuses = $this->_status->getOptionArray();

        $this->getMassactionBlock()->addItem(
            'status',
            [
                'label' => __('Change status'),
                'url' => $this->getUrl('addonproducts/*/massStatus', ['_current' => true]),
                'additional' => [
                    'visibility' => [
                        'name' => 'status',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => __('Status'),
                        'values' => $statuses
                    ]
                ]
            ]
        );


        return $this;
    }
		

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('addonproducts/*/index', ['_current' => true]);
    }

    /**
     * @param \OrviSoft\AddonProducts\Model\accessories|\Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row)
    {
		
        return $this->getUrl(
            'addonproducts/*/edit',
            ['id' => $row->getId()]
        );
		
    }

	
		static public function getOptionArray0()
		{
            $data_array=array(); 
			$data_array[0]='Yes';
			$data_array[1]='No';
            return($data_array);
		}
		static public function getValueArray0()
		{
            $data_array=array();
			foreach(\OrviSoft\AddonProducts\Block\Adminhtml\Accessories\Grid::getOptionArray0() as $k=>$v){
               $data_array[]=array('value'=>$k,'label'=>$v);		
			}
            return($data_array);

		}
		
		static public function getOptionArray14()
		{
            $data_array=array(); 
			$data_array[0]='Inactive';
			$data_array[1]='Active';
            return($data_array);
		}
		static public function getValueArray14()
		{
            $data_array=array();
			foreach(\OrviSoft\AddonProducts\Block\Adminhtml\Accessories\Grid::getOptionArray14() as $k=>$v){
               $data_array[]=array('value'=>$k,'label'=>$v);		
			}
            return($data_array);

		}
		

}
