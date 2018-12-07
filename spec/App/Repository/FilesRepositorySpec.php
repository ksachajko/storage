<?php

namespace spec\App\Repository;

use App\Repository\FilesRepository;
use App\Service\FilesystemsResolver;
use League\Flysystem\Filesystem;
use PhpSpec\ObjectBehavior;

class FilesRepositorySpec extends ObjectBehavior
{
    function let (FilesystemsResolver $filesystemsResolver)
    {
        $this->beConstructedWith($filesystemsResolver);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(FilesRepository::class);
    }

    function it_should_return_nothing_when_there_are_no_filesystems(FilesystemsResolver $filesystemsResolver)
    {
        $filesystemsResolver->getFilesystems()->shouldBeCalled()->willReturn([]);

        $this->findAll()->shouldReturn([]);
    }

    function it_should_return_nothing_when_there_there_where_no_files_found(
        FilesystemsResolver $filesystemsResolver,
        Filesystem $filesystem
    ) {
        $filesystemsResolver->getFilesystems()->shouldBeCalled()->willReturn([$filesystem]);

        $filesystem->listContents('', true)->shouldBeCalled()->willReturn([]);

        $this->findAll()->shouldReturn([]);
    }

    function it_should_return_all_articles_and_directories(
        FilesystemsResolver $filesystemsResolver,
        Filesystem $filesystem
    ) {
        $filesystemsResolver->getFilesystems()->shouldBeCalled()->willReturn([$filesystem]);

        $contents = [
            [
                'type' => 'dir',
                'basename' => 'Directory'
            ],
            [
                'type' => 'file',
                'basename' => 'example.txt'
            ]
        ];

        $filesystem->listContents('', true)->shouldBeCalled()->willReturn($contents);

        $this->findAll()->shouldReturn($contents);
    }

    function it_should_find_articles_only(
        FilesystemsResolver $filesystemsResolver,
        Filesystem $filesystem
    ) {
        $filesystemsResolver->getFilesystems()->shouldBeCalled()->willReturn([$filesystem]);

        $contents = [
            [
                'type' => 'dir',
                'basename' => 'example directory'
            ],
            [
                'type' => 'file',
                'basename' => 'example.txt'
            ]
        ];

        $filesystem->listContents('', true)->shouldBeCalled()->willReturn($contents);

        $this->find('xampl')->shouldReturn([
            [
                'type' => 'file',
                'basename' => 'example.txt'
            ]
        ]);
    }

    function it_should_find_articles_from_many_filesystems(
        FilesystemsResolver $filesystemsResolver,
        Filesystem $filesystem1,
        Filesystem $filesystem2
    ) {
        $filesystemsResolver->getFilesystems()->shouldBeCalled()->willReturn([$filesystem1, $filesystem2]);

        $contents1 = [
            [
                'type' => 'dir',
                'basename' => 'directory'
            ],
            [
                'type' => 'file',
                'basename' => 'example.txt'
            ]
        ];

        $contents2 = [
            [
                'type' => 'dir',
                'basename' => 'other directory'
            ],
            [
                'type' => 'file',
                'basename' => 'other example.txt'
            ]
        ];

        $filesystem1->listContents('', true)->shouldBeCalled()->willReturn($contents1);
        $filesystem2->listContents('', true)->shouldBeCalled()->willReturn($contents2);

        $this->find('xampl')->shouldReturn([
            [
                'type' => 'file',
                'basename' => 'example.txt'
            ],
            [
                'type' => 'file',
                'basename' => 'other example.txt'
            ]
        ]);
    }
}
