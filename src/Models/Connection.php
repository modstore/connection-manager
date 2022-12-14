<?php

namespace Modstore\ConnectionManager\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    use HasFactory;

    protected $table = 'connection_manager_connections';

    public $guarded = [];

    public function getDetailsAttribute()
    {
        return sprintf('%s@%s', $this->user, $this->host);
    }
}
