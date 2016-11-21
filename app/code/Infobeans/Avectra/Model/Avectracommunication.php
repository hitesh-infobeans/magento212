<?php
    /**
     * Hello Catalog Product Rewrite Model
     *
     * @category    Webkul
     * @package     Webkul_Hello
     * @author      Webkul Software Private Limited
     *
     */
    namespace Infobeans\Avectra\Model;
 
    class Avectracommunication extends \Magento\Framework\Model\AbstractModel
    {
        private $__token_path = null;
        public $_directory_list=null;
        private $_soapClient=null;
        //'/var/www/html/magento212/wsdl/avectra_eweb_login.wsdl';//
        private $_wsdl="https://av.iccsafe.org/xweb/Secure/netFORUMXML.asmx?WSDL";
        protected function _construct()
        { 
            
           /* $object_manager = Magento\Core\Model\ObjectManager::getInstance();
            $dir = $object_manager->get('Magento\App\Dir');            
           $base = $dir->getDir();
           var_dump($base);
            
            
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $this->_directory_list = $objectManager->create('\Magento\Framework\Filesystem\DirectoryList');  
                    echo $this->directory_list->getRoot();            exit;
//echo $this->_directory_list->getPath('app');
          
            
            echo "df";exit;*/
            
            //$this->__token_path = Mage::getBaseDir() .'/wsdl/avectra_eweb_login.wsdl';	 
            //$this->_storeManager->getStore()->getBaseUrl();    
            
            
        }
        
       protected function _initSoapClient($endpoint)
        {
            try {
                
                 $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $this->_soapClient = $objectManager->create('\Zend\Soap\Client');  
                #require_once 'Zend/Soap/Client.php';
                // = new Zend_Soap_Client();
                $this->_soapClient->setWsdl($endpoint);
                $header=new SoapHeader('http://www.avectra.com/2005/Authenticate','SOAPAction');
               // $header->name="SOAPAction";
               // $header->value="http://www.avectra.com/2005/Authenticate";
                $this->_soapClient->addSoapInputHeader($header);
               
            } catch (Zend_Soap_Client_Exception $e) {
                    echo $e->getMessage();exit;             
#require_once 'Zend/Service/LiveDocx/Exception.php';
               # throw new Zend_Service_LiveDocx_Exception('Cannot connect to Avectra service at ' . $endpoint, 0, $e);
            }
        }  
        
         public function getSoapClient()
        {
            return $this->_soapClient;
        }
        
        
       public function test()
       {
            
           if (null === $this->getSoapClient()) {
               
                $this->_initSoapClient($this->_wsdl);
                
            }
            
            try { 
                
               /* $this->getSoapClient()->__call(array(
                    'userName' => "iccxweb1",
                    'password' => "fVROIs6Q",
                )); */
                $function_name 	= "Authenticate";
              //  $arguments 		=  array('userName'=>"iccxweb1", 'password' => "fVROIs6Q");
                $arguments 		= array('parameters'=> array('userName'=>"iccxweb1", 'password' => "fVROIs6Q")); 
                echo "Here";  
                $soapresponse = $this->getSoapClient()->__call($function_name, $arguments);
                print_r($soapresponse);exit; 
                 
                $this->_loggedIn = true;
            } catch (Exception $e) {
                #require_once 'Zend/Service/LiveDocx/Exception.php';
                throw new Zend_Service_LiveDocx_Exception(
                    'Cannot login into Avectra service - username and/or password are invalid', 0, $e
                );
            }
            var_dump($this->_loggedIn) ;
            
            
       }
        
        
        
        
 
    }