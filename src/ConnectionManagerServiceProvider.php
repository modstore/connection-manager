<?php

namespace Modstore\ConnectionManager;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Modstore\ConnectionManager\Commands\ConnectionManagerCommand;

class ConnectionManagerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('connection-manager')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_connection-manager_table')
            ->hasCommand(ConnectionManagerCommand::class);
    }
}
