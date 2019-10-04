<?php

namespace OrviSoft\AddonProducts\Model\ResourceModel\Accessories;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('OrviSoft\AddonProducts\Model\Accessories', 'OrviSoft\AddonProducts\Model\ResourceModel\Accessories');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>