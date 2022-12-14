<?php

namespace Modstore\ConnectionManager\Commands;

use Illuminate\Console\Command;
use Modstore\ConnectionManager\Models\Connection;

class ConnectAddCommand extends Command
{
    public $signature = 'connect:add';

    public $description = 'Add a new connection';

    public function handle(): int
    {
        $this->comment('Adding a new connection');

        $name = $this->ask('Name of connection (short name to use for quick connect, no spaces)');
        $user = $this->ask('Username');
        $host = $this->ask('Host (IP or hostname)');
        $key = $this->ask('Location to key file (leave empty for none)');

        // TODO validate, ensure name is unique.

        Connection::create([
            'name' => $name,
            'user' => $user,
            'host' => $host,
            'key' => $key,
        ]);

        $this->comment('Connection successfully added');

        return self::SUCCESS;
    }
}
