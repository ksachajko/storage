<?php

namespace App\Adapter;

use Masbug\Flysystem\GoogleDriveAdapter as OriginalAdapter;

class GoogleDriveAdapter extends OriginalAdapter
{
    public function __construct(string $clientId, string $clientSecret, string $refreshToken)
    {
        $client = new \Google_Client();
        $client->setClientId($clientId);
        $client->setClientSecret($clientSecret);
        $client->refreshToken($refreshToken);
        $client->setApplicationName('My App');

        $service = new \Google_Service_Drive($client);

        parent::__construct($service);
    }
}
