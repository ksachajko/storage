<?php

namespace App\Repository;

use App\Service\FilesystemsResolver;
use League\Flysystem\Filesystem;

class FilesRepository
{
    private $filesystemsResolver;

    public function __construct(FilesystemsResolver $filesystemResolver)
    {
        $this->filesystemsResolver = $filesystemResolver;
    }

    public function findAll(): array
    {
        return $this->find();
    }

    public function find(string $query = ''): array
    {
        $results = [];

        foreach ($this->filesystemsResolver->getFilesystems() as $filesystem) {
            $filesystemResults = $this->findInFilesystem($filesystem, $query);

            $results = array_merge($results, $filesystemResults);
        }

        return $results;
    }

    private function findInFilesystem(Filesystem $filesystem, $query): array
    {
        # TODO What should happen on filesystem exception
        # Example: Remove Google Drive credentials.
        # You could get HTTP 500 Daily Limit for Unauthenticated Use Exceeded
        $contents = $filesystem->listContents('', true);

        if (!$contents) return [];

        if (!$query) return $contents;

        return array_filter($contents, function ($item) use ($query) {
            return $item['type'] !== 'dir' && strpos($item['basename'], $query) !== false;
        });
    }
}
