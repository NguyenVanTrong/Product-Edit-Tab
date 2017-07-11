<?php
namespace Meet\Productgridextend\Controller\Adminhtml\Index;
class Productgridextend extends \Magento\Framework\App\Action\Action
{
    protected $_resultPageFactory;
    protected $resultJsonFactory;
    protected $_errorHelper;
    /**
     * @param \Magento\Framework\App\Action\Context           $context
     * @param \Magento\Framework\View\Result\PageFactory      $resultPageFactory
     * @param \Magento\Framework\Controller\Result\RawFactory $resultRawFactory
     */
    public function __construct(
    \Magento\Framework\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magento\Framework\Controller\Result\RawFactory $resultRawFactory
    ) {
        $this->_resultPageFactory = $resultPageFactory;

        $this->resultRawFactory = $resultRawFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        $block = $resultPage->getLayout()->getBlock('product_productgridextend');
        $this->getResponse()->appendBody($block->toHtml());
    }
}