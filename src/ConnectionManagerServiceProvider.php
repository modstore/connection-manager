<?php

namespace Modstore\ConnectionManager;

use Modstore\ConnectionManager\Commands\ConnectAddCommand;
use Modstore\ConnectionManager\Commands\ConnectCommand;
use Modstore\ConnectionManager\Commands\ConnectRemoveCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ConnectionManagerServiceProvider extends PackageServiceProvider
{
    public function register()
    {
        // Only register this package in the local environment.
        if (!$this->app->isLocal()) {
            return $this;
        }

        return parent::register();
    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('connection-manager')
            ->hasMigration('create_connection_manager_table')
            ->hasCommand(ConnectAddCommand::class)
            ->hasCommand(ConnectCommand::class)
            ->hasCommand(ConnectRemoveCommand::class);
    }
}
