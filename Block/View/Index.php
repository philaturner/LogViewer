<?php
namespace PhilTurner\LogViewer\Block\View;

class Index extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \PhilTurner\LogViewer\Helper\Data
     */
    protected $logDataHelper;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \PhilTurner\LogViewer\Helper\Data $logDataHelper
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \PhilTurner\LogViewer\Helper\Data $logDataHelper,
        array $data = []
    )
    {
        $this->logDataHelper = $logDataHelper;
        parent::__construct($context, $data);
    }

    public function getLogFile()
    {
        $params = $this->_request->getParams();
        return $this->logDataHelper->getLastLinesOfFile($params[0], 10);
    }

    public function getFileName()
    {
        $params = $this->_request->getParams();
        return $params[0];
    }

}
