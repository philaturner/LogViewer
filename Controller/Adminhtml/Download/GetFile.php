<?php
namespace PhilTurner\LogViewer\Controller\Adminhtml\Download;

class GetFile extends AbstractLog
{
    protected function getFilePath()
    {
        return null;
    }

    protected function getFullPath($fileName)
    {
        return 'var/log/' . $fileName;
    }
}