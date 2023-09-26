<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\RoleResource;
use App\Http\Resources\PermissionResource;
use App\Models\Role;
use App\Models\Permissions;

class RolePermissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'role_id' => new RoleResource(Role::find($this->role_id)),
            'permission_id' => new PermissionResource(Permissions::find($this->permission_id)),
            'is_allowed' => $this->is_allowed,
            'created_at' => $this->created_at->format('d/m/Y H:i'),
            'updated_at' => $this->updated_at->format('d/m/Y H:i'),
        ];
    }
}
