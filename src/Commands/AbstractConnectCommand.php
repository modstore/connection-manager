<?php

namespace Modstore\ConnectionManager\Commands;

use Illuminate\Console\Command;
use Modstore\ConnectionManager\Models\Connection;

abstract class AbstractConnectCommand extends Command
{
    protected function selectConnection(): Connection
    {
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

        return $connection;
    }
}
