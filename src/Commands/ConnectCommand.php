<?php

namespace Modstore\ConnectionManager\Commands;

use Illuminate\Support\Collection;
use Modstore\ConnectionManager\Models\Connection;

class ConnectCommand extends AbstractConnectCommand
{
    public $signature = 'connect {name?}';

    public $description = 'Connect to a remote server';

    public function handle(): int
    {
        $name = $this->argument('name');

        // If name was specified, try to find and connect to that connection.
        if ($name !== null) {
            /** @var Connection $connection */
            $connection = Connection::where('name', $name)->first();

            if ($connection !== null) {
                return $this->connect($connection);
            }

            $this->error('Invalid connection');
        }

        $connection = $this->selectConnection();

        return $this->connect($connection);
    }

    protected function connect(Connection $connection): int
    {
        $this->comment(sprintf('Connecting to %s (%s)', $connection->name, $connection->details));

        $command = collect(['ssh'])
            ->when($connection->key !== null, function (Collection $collection) use ($connection) {
                return $collection->merge([sprintf('-i %s', $connection->key)]);
            })
            ->merge([sprintf('%s@%s', $connection->user, $connection->host)])
            ->implode(' ');

        passthru($command);

        return self::SUCCESS;
    }
}
