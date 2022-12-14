<?php

namespace Modstore\ConnectionManager;

use Modstore\ConnectionManager\Commands\ConnectAddCommand;
use Modstore\ConnectionManager\Commands\ConnectCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
            ->hasMigration('create_connection_manager_table')
            ->hasCommand(ConnectAddCommand::class)
            ->hasCommand(ConnectCommand::class);
    }
}
