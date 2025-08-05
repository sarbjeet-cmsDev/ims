<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerExport extends Model
{
    protected $fillable = [
        'queue',
        'status',
        'file_path',
        'error',
        'started_at',
        'finished_at',
    ];
}
