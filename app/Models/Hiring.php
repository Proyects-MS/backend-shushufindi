<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hiring extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'hiring';

    protected $fillable = [
        'name',
        'id_processtype'
    ];
}
