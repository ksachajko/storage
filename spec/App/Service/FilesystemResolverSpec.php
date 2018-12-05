<?php

namespace spec\App\Service;

use App\Service\FilesystemResolver;
use Gaufrette\Filesystem;
use Knp\Bundle\GaufretteBundle\FilesystemMap;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FilesystemResolverSpec extends ObjectBehavior
{
    public function let(FilesystemMap $filesystemMap)
    {
        $this->beConstructedWith($filesystemMap, 'local_uploads');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(FilesystemResolver::class);
    }

    function it_should_return_filesystem(FilesystemMap $filesystemMap, Filesystem $filesystem)
    {
        $filesystemMap->get('local_uploads')->willReturn($filesystem);

        $this->getFilesystem()->shouldReturn($filesystem);
    }
}
