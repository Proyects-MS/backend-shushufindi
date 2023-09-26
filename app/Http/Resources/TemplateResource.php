<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\StatesResource;
use App\Models\States;

use App\Models\Hiring;
use App\Http\Resources\HiringResource;

use App\Http\Resources\ProcessTypeResource;
use App\Models\ProcessType;

use App\Models\Procedure;
use App\Http\Resources\ProcedureResource;

class TemplateResource extends JsonResource
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
            'priority' => $this->priority,
            'state_id' => new StatesResource(States::find($this->state_id)),
            'type_process_id' => new ProcessTypeResource(ProcessType::find($this->type_process_id)),
            'hiring_id' => new HiringResource(Hiring::find($this->hiring_id)),
            'procedure_id' => new ProcedureResource(Procedure::find($this->procedure_id)),
            'description' => $this->description,
            'created_at' => $this->created_at->format('d/m/Y H:i'),
            'updated_at' => $this->updated_at->format('d/m/Y H:i'),
        ];
    }
}
