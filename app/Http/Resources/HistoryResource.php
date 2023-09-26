<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\ProcessResource;
use App\Models\Process;

use App\Http\Resources\TasksResource;
use App\Models\Tasks;

use App\Http\Resources\FilesResource;
use App\Models\Files;


class HistoryResource extends JsonResource
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
            'date' => $this->date,
            'description' => $this->description,
            'task_id' => new TasksResource(Tasks::find($this->task_id)),
            'process_id' => new ProcessResource(Process::find($this->process_id)),
            'file_id' => new FilesResource(Files::find($this->file_id)),
            'created_at' => $this->created_at->format('d/m/Y H:i'),
            'updated_at' => $this->updated_at->format('d/m/Y H:i'),
        ];
    }
}
