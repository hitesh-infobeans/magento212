<?php
    /**
     * Hello Catalog Product Rewrite Model
     *
     * @category    Webkul
     * @package     Webkul_Hello
     * @author      Webkul Software Private Limited
     *
     */
    namespace Infobeans\Avectra\Model\Customer;
 
    class Url extends \Magento\Customer\Model\Url
    {
        
        const AVECTRA_MODE_XML_PATH='avectra_section/general/avectra_mode';
        const DEV_MODE_URL_XML_PATH='avectra_section/general/test_url';
        const LIVE_MODE_URL_XML_PATH='avectra_section/general/live_url';
        
          
        
 
    }