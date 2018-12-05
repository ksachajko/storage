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
        return $this->filesystem->keys();
    }

    public function find(string $query)
    {
        $keys = $this->filesystem->keys();

        return array_filter($keys, function ($key) use ($query) {
            return strpos($key, $query) !== false;
        });
    }
}
