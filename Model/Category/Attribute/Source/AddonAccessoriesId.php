<?php


namespace OrviSoft\AddonProducts\Model\Category\Attribute\Source;

class AddonAccessoriesId extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{

    protected $_optionsData;
    protected $_accessoriesFactory;

    /**
     * Constructor
     *
     * @param array $options
     */
    public function __construct(
        array $options = null,
        \OrviSoft\AddonProducts\Model\AccessoriesFactory $AccessoriesFactory
        )
    {
        $this->_optionsData = $options;
        $this->_accessoriesFactory = $AccessoriesFactory;
    }

    /**
     * getAllOptions
     *
     * @return array
     */
    public function getAllOptions()
    {
        if ($this->_options === null) {
            $this->_options = $this->getAllAccessories();
        }
        return $this->_options;
    }

    public function getAllAccessories(){
        $data = $this->_accessoriesFactory->create()->getCollection()
                ->addFieldToSelect(array('id', 'label'))
                ->addFieldToFilter('is_active', array('eq' => 1)); // Status is set to Active.
        $output[] = ['value' => '0', 'label' => __('None')];
        foreach($data->getData() as $k => $v){
            $output[] = ['value' => $v['id'], 'label' => $v['label']];
        }
        return $output;
    }
}
