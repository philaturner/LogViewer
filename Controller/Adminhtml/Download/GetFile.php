<?php
namespace PhilTurner\LogViewer\Controller\Adminhtml\Download;

class GetFile extends AbstractLog
{
    protected function getFilePathWithFile($fileName)
    {
        return 'var/log/' . $fileName;
    }
}