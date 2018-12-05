<?php

namespace App\Service;

use Gaufrette\FilesystemInterface;
use Knp\Bundle\GaufretteBundle\FilesystemMap;

class FilesystemResolver
{
    private $filesystemMap;
    private $filesystemName;

    public function __construct(FilesystemMap $filesystemMap, string $filesystemName)
    {
        $this->filesystemMap = $filesystemMap;
        $this->filesystemName = $filesystemName;
    }

    public function getFilesystem(): FilesystemInterface
    {
        #TODO exception on filesystem not found or move to compiler pass
        return $this->filesystemMap->get($this->filesystemName);
    }
}
