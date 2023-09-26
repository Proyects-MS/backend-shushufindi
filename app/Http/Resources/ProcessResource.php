<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


use App\Http\Resources\UserResource;
use App\Models\User;

use App\Http\Resources\StatesResource;
use App\Models\States;

class ProcessResource extends JsonResource
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
            'date' => $this->date,
            'state_id' => new StatesResource(States::find($this->state_id)),
            'user_id' => new UserResource(User::find($this->user_id)),
            'user_asig_id' => new UserResource(User::find($this->user_asig_id)),
            'description' => $this->description,
            'last_updated_user' => new UserResource(User::find($this->last_updated_user)),
            'priority' => $this->priority,
            'hiring' => $this->hiring,
            'procedures' => $this->procedures,
            'time' => $this->time,
            'ending' => $this->ending,
            'hiring_class' => $this->hiring_class,
            'sequential' => $this->sequential,
            'last_assign_date' => $this->last_assign_date,
            'created_at' => $this->created_at->format('d/m/Y H:i'),
            'updated_at' => $this->updated_at->format('d/m/Y H:i'),
        ];
    }
}
