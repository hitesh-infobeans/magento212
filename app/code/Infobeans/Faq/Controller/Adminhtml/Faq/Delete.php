<?php
namespace Infobeans\Faq\Controller\Adminhtml\Faq;

use Magento\Backend\App\Action;
use Magento\TestFramework\ErrorLog\Logger;

class Delete extends \Magento\Backend\App\Action
{

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Infobeans_Faq::delete');
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('faq_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->_objectManager->create('Infobeans\Faq\Model\Faq');
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('The faq has been deleted.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['faq_id' => $id]);
            }
        }
        $this->messageManager->addError(__('We can\'t find a faq to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}