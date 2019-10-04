<?php
namespace OrviSoft\AddonProducts\Model\ResourceModel;

class Accessories extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('addon_accessories', 'id');
    }
}
?>