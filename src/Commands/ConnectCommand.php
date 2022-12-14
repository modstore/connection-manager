<?php

namespace Modstore\ConnectionManager\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Modstore\ConnectionManager\Models\Connection;

class ConnectCommand extends Command
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

        $connections = Connection::orderBy('name')->get();

        do {
            $this->table(
                ['#', 'Name', 'Details'],
                $connections->map(fn (Connection $connection, $index) => [$index + 1, $connection->name, $connection->details]),
            );

            $numberOrName = $this->ask('Please select a connection (# or name)');

            $connection = (is_numeric($numberOrName) && $connections->has($numberOrName - 1))
                ? $connections->get($numberOrName - 1)
                : $connections->filter(fn (Connection $connection) => $connection->name === $numberOrName)->first();

            if ($connection !== null) {
                break;
            }

            $this->error('Invalid connection');
        } while (true);

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
