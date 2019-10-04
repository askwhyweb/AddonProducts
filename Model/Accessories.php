<?php
namespace OrviSoft\AddonProducts\Model;

class Accessories extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('OrviSoft\AddonProducts\Model\ResourceModel\Accessories');
    }
}
?>