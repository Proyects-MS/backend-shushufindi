<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProcessType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'process_type';

    protected $fillable = [
        'name',
    ];
}
