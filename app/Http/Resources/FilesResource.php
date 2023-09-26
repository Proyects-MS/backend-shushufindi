<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\UserResource;
use App\Models\User;

use App\Http\Resources\ProcessResource;
use App\Models\Process;

use App\Http\Resources\StatesResource;
use App\Models\States;

use App\Http\Resources\CategoriesResource;
use App\Models\Categories;

class FilesResource extends JsonResource
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
            'user_id' => new UserResource(User::find($this->user_id)),
            'ext_file' => $this->ext_file,
            'type' => $this->type,
            'description' => $this->description,
            'url' => $this->url,
            'peso' => $this->peso,
            'last_updated_user' => new UserResource(User::find($this->last_updated_user)),
            'process_id' => new ProcessResource(Process::find($this->process_id)),
            'category_id' => new CategoriesResource(Categories::find($this->category_id)),
            'created_at' => $this->created_at->format('d/m/Y H:i'),
            'updated_at' => $this->updated_at->format('d/m/Y H:i'),
        ];
    }
}
