<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @method static firstOrCreate(array $array)
 */
class MediaLibrary extends Model implements HasMedia
{
    use InteractsWithMedia;

    /**
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $manipulations = new Manipulations();

        $manipulations->format(Manipulations::FORMAT_WEBP);

        $this->addMediaConversion('800x600')->width(800)->height(600)->setManipulations($manipulations);
        $this->addMediaConversion('1200x600')->width(1200)->height(600)->setManipulations($manipulations);
        $this->addMediaConversion('100x100')->crop(Manipulations::CROP_CENTER, 100, 100)
            ->width(100)->height(100)->setManipulations($manipulations);
    }
}
