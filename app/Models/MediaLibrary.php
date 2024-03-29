<?php

namespace App\Models;

use App\Models\Media as MediaModel;
use App\Overrides\MediaLibrary\HasMedia;
use App\Overrides\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\Image\Manipulations;

/**
 * @method static firstOrCreate(array $array)
 */
class MediaLibrary extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['collection_name', 'default'];

    /**
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(MediaModel $media = null): void
    {
        $manipulations = new Manipulations();

        $manipulations->format(Manipulations::FORMAT_WEBP);

        $this->addMediaConversion('800x600')->width(800)->height(600)->withResponsiveImages()
            ->setManipulations($manipulations);

        $this->addMediaConversion('1200x800')->width(1200)->height(800)->withResponsiveImages()
            ->setManipulations($manipulations);

        $this->addMediaConversion('720x480')->width(720)->height(480)->withResponsiveImages()
            ->setManipulations($manipulations->crop(Manipulations::CROP_CENTER, 720, 480));

        $this->addMediaConversion('100x100')->crop(Manipulations::CROP_CENTER, 100, 100)
            ->width(100)->height(100)->withResponsiveImages()
            ->setManipulations($manipulations);
    }

    public function medias(): HasMany
    {
        return $this->hasMany(MediaModel::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function docs(): HasMany
    {
        return $this->hasMany(Doc::class);
    }
}
