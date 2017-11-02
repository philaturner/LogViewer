<?php
namespace PhilTurner\LogViewer\Controller\Adminhtml\Download;

class DebugLog extends AbstractLog
{
    protected function getFilePath()
    {
        return 'var/log/debug.log';
    }
}