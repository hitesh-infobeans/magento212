<?php
namespace Infobeans\Faq\Block;

use Infobeans\Faq\Api\Data\FaqInterface;
use Infobeans\Faq\Model\ResourceModel\Faq\Collection as FaqCollection;

class Faqlist extends \Magento\Framework\View\Element\Template implements
    \Magento\Framework\DataObject\IdentityInterface
{
     /**
     * @var \Infobeans\Faq\Model\ResourceModel\Faq\CollectionFactory
     */
    protected $_faqCollectionFactory;
    
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;
    
    /**
     * Construct
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Infobeans\Faq\Model\ResourceModel\Faq\CollectionFactory $faqCollectionFactory,
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
     * @param array $data
     */
    
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Infobeans\Faq\Model\ResourceModel\Faq\CollectionFactory $faqCollectionFactory,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_faqCollectionFactory = $faqCollectionFactory;
        $this->scopeConfig = $scopeConfig;
    }
    
    /**
     * Return Page Title
     * @return \Magento\Framework\App\Config\ScopeConfigInterface
     */
    
    public function getPageTitle()
    {
        return $this->scopeConfig->getValue(
            'faq_section/general/page_title',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    
    /**
     * Return Meta Title
     * @return \Magento\Framework\App\Config\ScopeConfigInterface
     */
    public function getMetaTitle()
    {
        return $this->scopeConfig->getValue(
            'faq_section/general/meta_title',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    
    /**
     * Return Meta Keyword
     * @return \Magento\Framework\App\Config\ScopeConfigInterface
     */
    public function getMetaKeyword()
    {
        return $this->scopeConfig->getValue(
            'faq_section/general/meta_keyword',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    
    /**
     * Return Meta Description
     * @return \Magento\Framework\App\Config\ScopeConfigInterface
     */
    public function getMetaDescription()
    {
        return $this->scopeConfig->getValue(
            'faq_section/general/meta_description',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    
    
    /**
     * Set Page Title , Meta Title , Meta Keyword,
     * Meta Description
     */
    
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

         
        $pageTitle = $this->getPageTitle();
        $metaTitle = $this->getMetaTitle();
        $metaKeyword = $this->getMetaKeyword();
        $metaDescription = $this->getMetaDescription();
        $pageMainTitle = $this->getLayout()->getBlock('page.main.title');
        
        if ($pageTitle && $pageMainTitle) {
                $pageMainTitle->setPageTitle($pageTitle);
        }
       
        if ($metaTitle!="") {
            $this->pageConfig->getTitle()->set($metaTitle);
        }
        if ($metaKeyword!="") {
            $this->pageConfig->setKeywords($metaKeyword);
        }
        
        if ($metaDescription!="") {
            $this->pageConfig->setDescription($metaDescription);
        }
    }
    
    /**
     * @return \Infobeans\Faq\Model\ResourceModel\Faq\Collection
     */
    public function getFaqs()
    {
        if (!$this->hasData('faqs')) {
            $faqs = $this->_faqCollectionFactory
                ->create()
                ->addFilter('is_active', 1)
                ->addOrder(
                    FaqInterface::CREATION_TIME,
                    FaqCollection::SORT_ORDER_DESC
                );
            
            
            $this->setData('faqs', $faqs);
        }
        return $this->getData('faqs');
    }

    /**
     * Return identifiers for produced content
     *
     * @return array
     */
    public function getIdentities()
    {
        return [\Infobeans\Faq\Model\Faq::CACHE_TAG . '_' . 'list'];
    }
}
