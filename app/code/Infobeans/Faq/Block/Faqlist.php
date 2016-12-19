<?php
namespace Infobeans\Faq\Block;

use Infobeans\Faq\Api\Data\FaqInterface;
use Infobeans\Faq\Model\ResourceModel\Faq\Collection as FaqCollection;

class Faqlist extends \Magento\Framework\View\Element\Template implements
    \Magento\Framework\DataObject\IdentityInterface
{
    /**
     * @var \Ashsmith\Blog\Model\ResourceModel\Post\CollectionFactory
     */
    protected $_faqCollectionFactory;

    /**
     * Construct
     *
     * @param \Magento\Framework\View\Element\Template\Context $context 
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Infobeans\Faq\Model\ResourceModel\Faq\CollectionFactory $faqCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_faqCollectionFactory = $faqCollectionFactory;
    }

    
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
