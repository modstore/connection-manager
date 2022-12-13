<?php

namespace Modstore\ConnectionManager\Commands;

use Illuminate\Console\Command;

class ConnectionManagerCommand extends Command
{
    public $signature = 'connection-manager';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
