<?php

namespace OrviSoft\AddonProducts\Block\Adminhtml\Accessories\Edit\Tab;

/**
 * Accessories edit form main tab
 */
class Main extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @var \OrviSoft\AddonProducts\Model\Status
     */
    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \OrviSoft\AddonProducts\Model\Status $status,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        $this->_status = $status;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm()
    {
        /* @var $model \OrviSoft\AddonProducts\Model\BlogPosts */
        $model = $this->_coreRegistry->registry('accessories');

        $isElementDisabled = false;

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Item Information')]);

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        }

        $fieldset->addField(
            'label',
            'text',
            [
                'name' => 'label',
                'label' => __('Label'),
                'title' => __('Label'),
				
                'disabled' => $isElementDisabled
            ]
        );

        $fieldset->addField(
            'title_1',
            'text',
            [
                'name' => 'title_1',
                'label' => __('Title 1'),
                'title' => __('Title 1'),
				
                'disabled' => $isElementDisabled
            ]
        );
					
        $fieldset->addField(
            'products_1',
            'textarea',
            [
                'name' => 'products_1',
                'label' => __('Product SKUs'),
                'title' => __('Product SKUs'),
				
                'disabled' => $isElementDisabled
            ]
        );
					
        $fieldset->addField(
            'title_2',
            'text',
            [
                'name' => 'title_2',
                'label' => __('Title 2'),
                'title' => __('Title 2'),
				
                'disabled' => $isElementDisabled
            ]
        );
					
        $fieldset->addField(
            'products_2',
            'textarea',
            [
                'name' => 'products_2',
                'label' => __('Product SKUs'),
                'title' => __('Product SKUs'),
				
                'disabled' => $isElementDisabled
            ]
        );
					
        $fieldset->addField(
            'title_3',
            'text',
            [
                'name' => 'title_3',
                'label' => __('Title 3'),
                'title' => __('Title 3'),
				
                'disabled' => $isElementDisabled
            ]
        );
					
        $fieldset->addField(
            'products_3',
            'textarea',
            [
                'name' => 'products_3',
                'label' => __('Product SKUs'),
                'title' => __('Product SKUs'),
				
                'disabled' => $isElementDisabled
            ]
        );
									
						
        $fieldset->addField(
            'is_active',
            'select',
            [
                'label' => __('Status'),
                'title' => __('Status'),
                'name' => 'is_active',
				
                'options' => \OrviSoft\AddonProducts\Block\Adminhtml\Accessories\Grid::getOptionArray14(),
                'disabled' => $isElementDisabled
            ]
        );
						
						

        if (!$model->getId()) {
            $model->setData('is_active', $isElementDisabled ? '0' : '1');
        }

        $form->setValues($model->getData());
        $this->setForm($form);
		
        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Item Information');
    }

    /**
     * Prepare title for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Item Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
    
    public function getTargetOptionArray(){
    	return array(
    				'_self' => "Self",
					'_blank' => "New Page",
    				);
    }
}
