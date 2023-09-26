<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Involucrados extends Model
{
    use HasFactory;

    protected $table = 'involucrados';

    protected $fillable = [
        'user_id', 'process_id', 'estado'
    ];
}
