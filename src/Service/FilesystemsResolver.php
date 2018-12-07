<?php

namespace App\Service;

use League\Flysystem\MountManager;

class FilesystemsResolver
{
    private $mountManager;
    private $filesystems;

    public function __construct(MountManager $mountManager, array $filesystems)
    {
        $this->mountManager = $mountManager;
        $this->filesystems = $filesystems;
    }

    public function getFilesystems(): array
    {
        $filesystems = [];

        foreach ($this->filesystems as $filesystem) {
            $filesystems[] = $this->mountManager->getFilesystem($filesystem);
        }

        return $filesystems;
    }
}
