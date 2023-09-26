<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Role;
use App\Models\Permissions;


class RolePermission extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'role_to_permissions';

    protected $fillable = [
        'role_id', 'permission_id', 'is_allowed',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function permissions()
    {
        return $this->belongsTo(Permissions::class, 'permission_id');
    }

}
