<?php

namespace Modstore\ConnectionManager\Commands;

use Illuminate\Console\Command;
use Modstore\ConnectionManager\Models\Connection;

class ConnectCommand extends Command
{
    public $signature = 'connect {name?}';

    public $description = 'Connect to a remote server';

    public function handle(): int
    {
        $name = $this->argument('name');

        if ($name === null) {
            $connections = Connection::orderBy('name')->get();
            $this->table(
                ['#', 'Name', 'Details'],
                $connections->map(fn (Connection $connection, $index) => [$index + 1, $connection->name, $connection->details]),
            );

            $numberOrName = $this->ask('Please select a connection (# or name)');

            $connection = (is_numeric($numberOrName) && $connections->has($numberOrName - 1))
                ? $connections->get($numberOrName - 1)
                : $connections->filter(fn (Connection $connection) => $connection->name === $numberOrName)->first();
        } else {
            /** @var Connection $connection */
            $connection = Connection::where('name', $name)->firstOrFail();
        }

        // TODO put this in a loop so can try again.
        if ($connection === null) {
            $this->error('Invalid connection');

            return self::FAILURE;
        }

        $this->comment(sprintf('Connecting to %s (%s@%s)', $connection->name, $connection->user, $connection->host));

        passthru(sprintf('ssh %s@%s', $connection->user, $connection->host));

        return self::SUCCESS;
    }
}
