<?php
namespace PhilTurner\LogViewer\Controller\Adminhtml\Download;

class ExceptionLog extends AbstractLog
{
    protected function getFilePath()
    {
        return 'var/log/exception.log';
    }
}