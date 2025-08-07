<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataJob extends Model
{
    protected $fillable = [
        'type',
        'queue',
        'started_at',
        'finished_at',
        'status',
        'file_path',
        'report_path',
        'error_message',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
    ];
}