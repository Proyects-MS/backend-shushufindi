<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\State;


class Process extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'process';

    protected $fillable = [
        'name',
        'date',
        'user_asig_id',
        'user_id',
        'description',
        'state_id',
        'last_updated_user',
        'priority',
        'hiring',
        'procedures',
        'time',
        'ending',
        'hiring_class',
        'sequential',
        'last_assign_date',

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user_asig()
    {
        return $this->belongsTo(User::class, 'user_asig_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function last_updated_user()
    {
        return $this->belongsTo(User::class, 'last_updated_user');
    }


}
