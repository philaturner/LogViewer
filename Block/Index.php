<?php
namespace PhilTurner\LogViewer\Block;

class Index extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \PhilTurner\LogViewer\Helper\Data
     */
    protected $_logDataHelper;

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
        $this->_logDataHelper = $logDataHelper;
        parent::__construct($context, $data);
    }

    public function getLogFiles()
    {
        return $this->_logDataHelper->buildLogData();
    }

    public function downloadLogFiles($fileName)
    {
        return $this->getUrl('logviewer/download/getfile', [$fileName]);
    }
}