<?php

namespace spec\App\Service;

use App\Service\FilesystemsResolver;
use League\Flysystem\Filesystem;
use League\Flysystem\MountManager;
use PhpSpec\ObjectBehavior;

class FilesystemsResolverSpec extends ObjectBehavior
{
    function it_is_initializable(MountManager $mountManager)
    {
        $this->beConstructedWith($mountManager, []);

        $this->shouldHaveType(FilesystemsResolver::class);
    }

    function it_should_return_no_filesystems(MountManager $mountManager)
    {
        $this->beConstructedWith($mountManager, []);

        $this->getFilesystems()->shouldReturn([]);
    }

    function it_should_return_filesystem(MountManager $mountManager, Filesystem $filesystem1, Filesystem $filesystem2)
    {
        $this->beConstructedWith($mountManager, ['local_uploads', 'dropbox']);

        $mountManager->getFilesystem('local_uploads')->willReturn($filesystem1);
        $mountManager->getFilesystem('dropbox')->willReturn($filesystem2);

        $this->getFilesystems()->shouldReturn([$filesystem1, $filesystem2]);
    }
}
