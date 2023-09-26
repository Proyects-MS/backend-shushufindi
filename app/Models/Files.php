<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Files extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'files';

    protected $fillable = [
        'name', 'date', 'user_id', 'ext_file', 'type', 'description', 'url', 'peso', 'last_updated_user', 'process_id', 'category_id',
    ];
}
