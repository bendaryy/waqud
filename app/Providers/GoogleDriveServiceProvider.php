<?php

namespace App\Providers;

use Google_Client;
use Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;


class GoogleDriveServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        \Storage::extend("google", function ($app, $config) {

    $client = new \Google_Client;
    $client->setClientId($config['clientId']);
    $client->setScopes(\Google_Service_Drive::DRIVE_METADATA_READONLY);
    $client->setClientSecret($config['clientSecret']);
    $client->refreshToken($config['refreshToken']);
    $service = new \Google_Service_Drive($client);
    $adabter = new GoogleDriveAdapter($service, $config['folderId']);
    return new Filesystem($adabter);
});

    }
}
