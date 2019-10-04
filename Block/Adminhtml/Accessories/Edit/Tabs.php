<?php
namespace OrviSoft\AddonProducts\Block\Adminhtml\Accessories\Edit;

/**
 * Admin page left menu
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('accessories_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Accessories Information'));
    }
}