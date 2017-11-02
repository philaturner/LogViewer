<?php
namespace PhilTurner\LogViewer\Helper;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

class Data extends AbstractHelper
{
    /**
     * @var DirectoryList
     */
    protected $directoryList;

    public function __construct(
        Context $context,
        DirectoryList $directoryList
    ) {
        $this->directoryList = $directoryList;
        parent::__construct(
            $context
        );
    }

    public function _getPath()
    {
        $rootPath = $this->directoryList->getRoot();
        $path =
            $rootPath . DIRECTORY_SEPARATOR . 'var' . DIRECTORY_SEPARATOR . 'log'. DIRECTORY_SEPARATOR;
        return $path;
    }

    protected function _getLogFiles()
    {
        $path = $this->_getPath();
        return scandir($path);
    }

    protected function filesizeToReadableString($bytes, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
        $bytes /= pow(1024, $pow);
        // $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    public function buildLogData()
    {
        $maxNumOfLogs = 30;
        $logFileData = [];
        $path = $this->_getPath();
        $files = $this->_getLogFiles();

        //remove rubbish from array
        array_splice($files, 0, 2);

        foreach ($files as $file) {
            $logFileData[$file]['name'] = $file;
            $logFileData[$file]['filesize'] = $this->filesizeToReadableString((filesize($path . $file)));
            $logFileData[$file]['modTime'] = filemtime($path . $file);
            $logFileData[$file]['modTimeLong'] = date("F d Y H:i:s.", filemtime($path . $file));
            //$logFileData[$file]['downloadURL'] = $path . $file;
            //$logFileData[$file]['contents'] = file_get_contents($path . $file);
        }

        //sort array by modified time
        usort($logFileData, function ($item1, $item2) {
            return $item2['modTimeLong'] <=> $item1['modTimeLong'];
        });

        //limit the amount of log to return
        $logFileData = array_slice($logFileData, 0, $maxNumOfLogs);

        return $logFileData;
    }
}