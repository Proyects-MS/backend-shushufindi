<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistoryFiles extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'history_files';

    protected $fillable = [
        'file_id',
        'description',
        'url',
        'date',
        'reason',
    ];
}
