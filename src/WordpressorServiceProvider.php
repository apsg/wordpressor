<?php
namespace Apsg\Wordpressor;

use Apsg\Wordpressor\Commands\ClearCacheCommand;
use Apsg\Wordpressor\Commands\PrecacheCommand;
use Apsg\Wordpressor\Commands\RefreshCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class WordpressorServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package) : void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('wordpressor')
            ->hasConfigFile()
            ->hasCommands([
                ClearCacheCommand::class,
                PrecacheCommand::class,
                RefreshCommand::class,
            ]);
    }
}
