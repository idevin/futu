<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed id
 * @property mixed name
 * @property mixed email
 * @property mixed provider
 * @property mixed provider_id
 * @property mixed registered_at
 * @property mixed roles
 */
class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'provider' => $this->provider,
            'provider_id' => $this->provider_id,
            'registered_at' => $this->registered_at->toIso8601String(),
            'comments_count' => $this->comments_count ?? $this->comments()->count(),
            'posts_count' => $this->posts_count ?? $this->posts()->count(),
            'roles' => Role::collection($this->roles),
        ];
    }
}
