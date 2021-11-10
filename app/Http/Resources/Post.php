<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed id
 * @property mixed title
 * @property mixed slug
 * @property mixed content
 * @property Carbon posted_at
 * @property mixed author_id
 */
class Post extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'posted_at' => $this->posted_at->toIso8601String(),
            'author_id' => $this->author_id,
            'comments_count' => $this->comments_count ?? $this->comments()->count(),
            'thumbnail_url' => $this->when($this->hasThumbnail(), url(optional($this->thumbnail)->getUrl())),
            'thumb_thumbnail_url' => $this->when($this->hasThumbnail(), url(optional($this->thumbnail)->getUrl()))
        ];
    }
}
