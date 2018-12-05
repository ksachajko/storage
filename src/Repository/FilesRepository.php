<?php

namespace App\Repository;

use App\Service\FilesystemResolver;

class FilesRepository
{
    private $filesystem;

    public function __construct(FilesystemResolver $filesystemResolver)
    {
        $this->filesystem = $filesystemResolver->getFilesystem();
    }

    public function getAll(): array
    {
        return $this->filesystem->listKeys();
    }
}
