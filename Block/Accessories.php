<?php

namespace OrviSoft\AddonProducts\Block;


class Accessories extends \Magento\Framework\View\Element\Template {
    protected $_coreRegistry;
    protected $_imageBuilder;
    protected $_reviewSummaryFactory;
    protected $_productModel;
    protected $_productPrices;
    protected $_priceCurrency;
    protected $_category;
    protected $_productList;

    /**
     * @var \OrviSoft\AddonProducts\Model\accessoriesFactory
     */
    protected $_accessoriesFactory;
    
    public function __construct(\Magento\Catalog\Block\Product\Context $productContext,
                                \Magento\Review\Model\Review\SummaryFactory $reviewSummaryFactory,
                                \Magento\Framework\View\Element\Template\Context $context, 
                                array $data = [],
                                \OrviSoft\AddonProducts\Model\AccessoriesFactory $AccessoriesFactory,
                                \Magento\Catalog\Model\Product $productModel,
                                \Magento\Catalog\Block\Product\ListProduct $productPrices,
                                \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
                                \Magento\Catalog\Model\Category $category,
                                \Magento\Catalog\Block\Product\ListProduct $productlist
                                )
    {
        $this->_accessoriesFactory = $AccessoriesFactory;
        $this->_coreRegistry = $productContext->getRegistry();
        $this->_reviewSummaryFactory = $reviewSummaryFactory;
        $this->_imageBuilder = $productContext->getImageBuilder();
        $this->_productModel = $productModel;
        $this->_productPrices = $productPrices;
        $this->_priceCurrency = $priceCurrency;
        $this->_category = $category;
        $this->_productList = $productlist;
        parent::__construct($context, $data);
    }
    
    public function getProductListBlock(){
        return $this->_productList;
    }

    public function getProduct()
    {
        return $this->_coreRegistry->registry('product');
    }

    public function getImage($product, $imageId, $attributes = [])
    {
        return $this->_imageBuilder->setProduct($product)
            ->setImageId($imageId)
            ->setAttributes($attributes)
            ->create();
    }
    
    public function getReviewSummary()
    {
        $storeId = $this->_storeManager->getStore()->getId();
        $reviewSummary = $this->_reviewSummaryFactory->create();
        $reviewSummary->setData('store_id', $storeId);
        $summaryModel = $reviewSummary->load($this->getProduct()->getId());

        return $summaryModel;
    }

    public function getProductPrices($product){
        return $this->_productPrices->getProductPrice($product);
    }
    
    public function getCurrencyCode() {
        return $this->_priceCurrency->getCurrency()->getCurrencySymbol();
    }

    public function addToCartUrl($product){
        return $this->_productPrices->getAddToCartUrl($product);
    }

    public function loadProductsBySku($skus){
        $skus = (string) $skus;
        $arrSkus = explode(',', $skus);
        $products = $this->_productModel->getCollection()
                ->addAttributeToSelect('*')
                ->addAttributeToFilter(
                    'sku', ['in' => $arrSkus]
            );
        return $products;
    }

    public function getCategory($id){
        return $this->_category->load($id);
    }

    public function getAllAccessories($product = false){
        $data = $this->_accessoriesFactory->create()->getCollection()
                ->addFieldToFilter('is_active', array('eq' => 1)); // Status is set to Active.
        if($product){
            $_product = $this->getProduct();
            $accessoriesId = $_product->getData('addon_accessories');
            if((int) $accessoriesId > 0){
                $output = $data;
                $output->addFieldToFilter('id', array('eq' => (int)$accessoriesId));
                if($output){
                    return $output;
                }
            }
            $categories = $_product->getCategoryIds();
            foreach($categories as $catID){
                $_category = $this->getCategory($catID);
                if((int) $_category->getData('addon_accessories_id') > 0){
                    $accessoriesId = $_category->getData('addon_accessories_id');
                    $output = $data;
                    $output->addFieldToFilter('id', array('eq' => (int)$accessoriesId));
                    if($output){
                        return $output;
                    }
                }
            }
            return false;
        }
        return $data;
    }
}
