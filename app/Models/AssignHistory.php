<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssignHistory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'assign_history';

    protected $fillable = [
        'user_id',
        'date',
        'process_id',
    ];
}
