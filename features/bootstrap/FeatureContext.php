<?php

use Behat\Behat\Context\Context;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * This context class contains the definitions of the steps used by the demo 
 * feature file. Learn how to get started with Behat and BDD on Behat's website.
 * 
 * @see http://behat.org/en/latest/quick_start.html
 */
class FeatureContext implements Context
{
    /**
     * @var KernelInterface
     */
    private $kernel;

    /**
     * @var Response|null
     */
    private $response;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @Given there are stored files
     */
    public function thereAreStoredFiles()
    {
        $rootPath = dirname(__DIR__) . '/../';

        $files = [
            'avatar-default.jpg',
            'testimg.jpg'
        ];

        $destinationDir = $rootPath . '/uploads/';

        if (!file_exists($destinationDir)) {
            mkdir($destinationDir, 0777, true);
        }

        foreach ($files as $file) {
            copy($rootPath . 'features/assets/' . $file, $destinationDir . $file);
        }
    }
}
