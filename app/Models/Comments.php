<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Process;


class Comments extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'comments';

    protected $fillable = [
        'date', 'comment', 'user_id', 'process_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function process()
    {
        return $this->belongsTo(Process::class, 'process_id');
    }
}




