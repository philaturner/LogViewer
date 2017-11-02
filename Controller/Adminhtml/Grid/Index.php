<?php
namespace PhilTurner\LogViewer\Controller\Adminhtml\Grid;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * Constructor
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Load the page defined in view/adminhtml/layout/logviewer_grid_index.xml
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {

        $this->_view->loadLayout();
        $this->_setActiveMenu('Magento_Backend::system');
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Log Viewer'));
        $this->_view->renderLayout();

    }
}