<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\RoleResource;
use App\Models\Role;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'profile_photo_path' => $this->profile_photo_path,
            'signature_password' => $this->signature_password,
            'signature' => $this->signature,
            'identification_card' => $this->identification_card,
            'role_id' => new RoleResource(Role::find($this->role_id)),
            //'role_id' => $this->role_id,
            'created_at' => $this->created_at->format('d/m/Y H:i'),
            'updated_at' => $this->updated_at->format('d/m/Y H:i'),
            'status' => $this->status,
            'position' => $this->position,
            
        ];
    }
}
