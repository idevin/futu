<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property int id
 * @property string name
 * @property string slug
 */
class Tag extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    #[ArrayShape(['id' => "int", 'name' => "string", 'slug' => "string"])]
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug
        ];
    }
}
