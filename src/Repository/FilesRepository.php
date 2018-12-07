<?php

namespace App\Repository;

use App\Service\FilesystemsResolver;
use League\Flysystem\Exception;
use League\Flysystem\Filesystem;

class FilesRepository
{
    private $filesystems;

    public function __construct(FilesystemsResolver $filesystemResolver)
    {
        $this->filesystems = $filesystemResolver->getFilesystems();
    }

    public function getAll(): array
    {
        return $this->find();
    }

    public function find(string $query = ''): array
    {
        $results = [];

        foreach ($this->filesystems as $filesystem) {
            try {
                $filesystemResults = $this->findInFilesystem($filesystem, $query);

                $results = array_merge($results, $filesystemResults);
            } catch (\Exception $e) {
                # TODO log exception
            }
        }

        return $results;
    }

    private function findInFilesystem(Filesystem $filesystem, $query): array
    {
        $contents = $filesystem->listContents();

        if (!$contents) return [];

        if (!$query) return $contents;

        return array_filter($contents, function ($item) use ($query) {
            return strpos($item['basename'], $query) !== false;
        });
    }
}
