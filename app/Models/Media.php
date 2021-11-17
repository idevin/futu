<?php

namespace App\Models;

use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

class Media extends BaseMedia
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'posted_at'
    ];

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
}
