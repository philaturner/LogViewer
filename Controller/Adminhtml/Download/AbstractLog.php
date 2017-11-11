<?php
namespace PhilTurner\LogViewer\Controller\Adminhtml\Download;

use Magento\Backend\App\Action\Context;
use Magento\Backend\Controller\Adminhtml\System;
use Magento\Framework\App\Response\Http\FileFactory;
use Magento\Framework\Exception\NotFoundException;
use Zend_Filter_BaseName;

abstract class AbstractLog extends System
{
    /**
     * @var FileFactory
     */
    protected $fileFactory;
    public function __construct(Context $context, FileFactory $fileFactory)
    {
        $this->fileFactory = $fileFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $param = $this->getRequest()->getParams();
        $filePath = $this->getFilePathWithFile($param[0]);

        $filter   = new Zend_Filter_BaseName();
        $fileName = $filter->filter($filePath);
        try {
            return $this->fileFactory->create(
                $fileName,
                [
                    'type'  => 'filename',
                    'value' => $filePath
                ]
            );
        } catch (\Exception $e) {
            throw new NotFoundException(__($e->getMessage()));
        }
    }

    /**
     * @param $filename
     * @return string
     */
    abstract protected function getFilePathWithFile($filename);
}