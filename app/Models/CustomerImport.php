<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CustomerImport extends Model
{
    protected $fillable = [
        'file_path',
        'status',
        'started_at',
        'finished_at',
        'report_path',
        'error',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
    ];
}