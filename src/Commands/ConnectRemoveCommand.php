<?php

namespace Modstore\ConnectionManager\Commands;

class ConnectRemoveCommand extends AbstractConnectCommand
{
    public $signature = 'connect:remove';

    public $description = 'Remove a connection';

    public function handle(): int
    {
        $this->error('******* Remove a connection *******');

        $connection = $this->selectConnection();

        if (!$this->confirm(sprintf('Are you sure you\'d like to delete connection: %s', $connection->details))) {
            return self::FAILURE;
        }

        $connection->delete();

        $this->comment('Connection successfully deleted');

        return self::SUCCESS;
    }
}
