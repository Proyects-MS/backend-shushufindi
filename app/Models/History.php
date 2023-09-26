<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class History extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'history';

    protected $fillable = [
        'description',
        'date',
        'task_id',
        'process_id',
        'file_id',
    ];
}
