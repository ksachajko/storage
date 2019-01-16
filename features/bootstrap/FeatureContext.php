<?php

use Behat\Behat\Context\Context;

class FeatureContext implements Context
{
    /**
     * @Given there are stored files
     */
    public function thereAreStoredFiles()
    {
        $rootPath = dirname(__DIR__) . '/../';
        $uploadsPath = $rootPath . '/uploads/';

        $files = [
            'testpdf.pdf',
            'testimg.jpg'
        ];

        $assetsPath = $rootPath . 'features/assets/';
        foreach ($files as $file) {
            copy($assetsPath . $file, $uploadsPath . $file);
        }

        $subdirectory = $uploadsPath . '/folder/';

        if (!file_exists($subdirectory)) {
            mkdir($subdirectory, 0777, true);
        }

        $fileName = 'testpdf-subdirectory.pdf';
        copy($assetsPath . $fileName, $subdirectory . $fileName);
    }
}
