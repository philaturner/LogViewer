<?php
namespace PhilTurner\LogViewer\Controller\Adminhtml\Download;

class SysLog extends AbstractLog
{
    protected function getFilePath()
    {
        return 'var/log/system.log';
    }
}