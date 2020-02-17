<?php


namespace OrviSoft\Enhancedecommerce\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Catalog\Helper\Data;

class Track extends AbstractHelper
{
    protected $scopeConfig;
    protected $_registry;
    protected $_categoryCollectionFactory;
    protected $_productRepository;
    protected $product;
    protected $helper;
    protected $_checkoutSession;
    protected $order;
    /**
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        \Magento\Framework\Registry $registry,
        Data $helper,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Sales\Model\Order $order
    ) {
        parent::__construct($context);
        $this->scopeConfig = $scopeConfig;
        $this->_registry = $registry;
        $this->_categoryCollectionFactory = $categoryCollectionFactory;
        $this->_productRepository = $productRepository;
        $this->helper = $helper;
        $this->_checkoutSession = $checkoutSession;
        $this->order = $order;
    }

    public function isActive(){
        return (boolean) $this->scopeConfig->getValue('enhanced_ecommerce/options/is_active', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getAnalyticsId(){
        return $this->scopeConfig->getValue('enhanced_ecommerce/options/analytics_id', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getCurrentCategory(){
        return $this->_registry->registry('current_category');
    }

    public function getCurrentProduct(){
        if(is_null($this->product)){
            $this->product = $this->helper->getProduct();
            print_r($this->product);
            exit;
        }
        return $this->product;
    }

    public function getBrand($_product){
        $brandAttribute = $this->scopeConfig->getValue('enhanced_ecommerce/options/brand', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $outputValue = $_product->getAttributeText($brandAttribute);
        if(strlen($outputValue)){
            $outputValue = addslashes($outputValue);
            return ",'brand': '$outputValue'";
        }
        return '';
    }

    /**
     * Get category collection
     *
     * @param bool $isActive
     * @param bool|int $level
     * @param bool|string $sortBy
     * @param bool|int $pageSize
     * @return \Magento\Catalog\Model\ResourceModel\Category\Collection or array
     */
    public function getCategoryCollection($isActive = true, $level = false, $sortBy = false, $pageSize = false)
    {
        $collection = $this->_categoryCollectionFactory->create();
        $collection->addAttributeToSelect('*');        
        
        // select only active categories
        if ($isActive) {
            $collection->addIsActiveFilter();
        }
                
        // select categories of certain level
        if ($level) {
            $collection->addLevelFilter($level);
        }
        
        // sort categories by some value
        if ($sortBy) {
            $collection->addOrderField($sortBy);
        }
        
        // select certain number of categories
        if ($pageSize) {
            $collection->setPageSize($pageSize); 
        }    
        
        return $collection;
    }

    public function getCategoryName($_product){
        try{
            $categoryIds = $_product->getCategoryIds(); 
            $categories = $this->getCategoryCollection(true, 0)
                                ->addAttributeToFilter('entity_id', $categoryIds);
                                
            foreach ($categories as $category) {
                $catName = $category->getName();
                return ", 'category': '$catName'";
            }}
        catch(\Exception $e){
            return '';
        }
        return '';
    }

    public function getOrder(){
        return $this->_checkoutSession->getLastRealOrder();
    }

    public function getSpecificOrder($incrementId){
        return $this->order->loadByIncrementId($incrementId);
    }

}
