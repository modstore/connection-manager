<?php

namespace Modstore\ConnectionManager\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Modstore\ConnectionManager\ConnectionManager
 */
class ConnectionManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Modstore\ConnectionManager\ConnectionManager::class;
    }
}
