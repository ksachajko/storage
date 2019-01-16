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
        #TODO group results by filesystem
        $results = [];

        foreach ($this->filesystemsResolver->getFilesystems() as $filesystem) {
            $filesystemResults = $this->findInFilesystem($filesystem, $query);

            $results = array_merge($results, $filesystemResults);
        }

        return $results;
    }

    private function findInFilesystem(Filesystem $filesystem, $query): array
    {
        $contents = [];

        try {
            $contents = $filesystem->listContents('', true);
        } catch (\Exception $e) {
            # TODO What should happen on filesystem exception
            # Example: run app without Google Drive credentials
            # There will be exception: Daily Limit for Unauthenticated Use Exceeded and HTTP 500 response without suppressing
        }

        if (!$contents) return [];

        if (!$query) return $contents;

        return array_filter($contents, function ($item) use ($query) {
            return $item['type'] !== 'dir' && strpos($item['basename'], $query) !== false;
        });
    }
}
