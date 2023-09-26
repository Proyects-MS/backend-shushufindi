<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;
    protected $table = 'template';

    protected $fillable = [
        'name',
        'priority',
        'state_id',
        'type_process_id',
        'hiring_id',
        'procedure_id',
        'description',
    ];
}
