<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

class Media extends BaseMedia
{
    /**
     * The attributes that should be mutated to date.
     *
     * @var array
     */
    protected $dates = [
        'posted_at'
    ];

    protected $fillable = ['media_library_id'];

    public function getImageInfo(string $property): string|int
    {
        $sizes = getimagesize($this->getPath());

        $info = [
            'width' => $sizes[0],
            'height' => $sizes[1],
            'html_size' => $sizes[3],
            'mime' => $sizes['mime']
        ];

        return $info[$property];
    }

    public function library(): BelongsTo
    {
        return $this->belongsTo(MediaLibrary::class, 'media_library_id');
    }

    public function scopeDefaultCollection($query)
    {
        $query->with(['library' => function($query){
            $query->where('default', 1);
        }]);
    }
}
