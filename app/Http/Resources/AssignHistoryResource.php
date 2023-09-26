<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


use App\Http\Resources\ProcessResource;
use App\Models\Process;

use App\Http\Resources\UserResource;
use App\Models\User;



class AssignHistoryResource extends JsonResource
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
            'user_id' => new UserResource(User::find($this->user_id)),
            'date' => $this->date,
            'process_id' => new ProcessResource(Process::find($this->process_id)),
            'created_at' => $this->created_at->format('d/m/Y H:i'),
            'updated_at' => $this->updated_at->format('d/m/Y H:i'),
        ];
    }
}
