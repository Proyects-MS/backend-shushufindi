<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\UserResource;
use App\Models\User;

use App\Http\Resources\ProcessResource;
use App\Models\Process;


use App\Http\Resources\FilesResource;
use App\Models\Files;


class TasksResource extends JsonResource
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
            'description' => $this->description,
            'date' => $this->date,
            'user_id' => new UserResource(User::find($this->user_id)),
            'user_asig_id' => new UserResource(User::find($this->user_asig_id)),
            'process_id' => new ProcessResource(Process::find($this->process_id)),
            'file_id' => new FilesResource(Files::find($this->file_id)),
            'status' => $this->status,
            'created_at' => $this->created_at->format('d/m/Y H:i'),
            'updated_at' => $this->updated_at->format('d/m/Y H:i'),
        ];
    }
}
