<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;
use App\Models\User;

use App\Http\Resources\ProcessResource;
use App\Models\Process;



class CommentsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'comment' => $this->comment,
            'user_id' => new UserResource(User::find($this->user_id)),
            'process_id' => new ProcessResource(Process::find($this->process_id)),
            'created_at' => $this->created_at->format('d/m/Y H:i'),
            'updated_at' => $this->updated_at->format('d/m/Y H:i'),
        ];
    }
}
