<?php

namespace App\Overrides\MediaLibrary;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\Conversions\Conversion;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface HasMedia
{
    public function media(): MorphMany;

    /**
     * Move a file to the media library.
     *
     * @param string|UploadedFile $file
     *
     * @return FileAdder
     */
    public function addMedia($file): FileAdder;

    /**
     * Copy a file to the media library.
     *
     * @param string|UploadedFile $file
     *
     * @return FileAdder
     */
    public function copyMedia($file): FileAdder;

    public function hasMedia(string $collectionMedia = ''): bool;

    /**
     * Get media collection by its collectionName.
     *
     * @param string $collectionName
     * @param array|callable $filters
     *
     * @return Collection
     */
    public function getMedia(string $collectionName = 'default', $filters = []): Collection;

    public function clearMediaCollection(string $collectionName = 'default'): HasMedia;

    /**
     * Remove all media in the given collection except some.
     *
     * @param string $collectionName
     * @param Media[]|Collection $excludedMedia
     *
     * @return $this
     */
    public function clearMediaCollectionExcept(string $collectionName = 'default', $excludedMedia = []): HasMedia;

    /**
     * Determines if the media files should be preserved when the media object gets deleted.
     *
     * @return bool
     */
    public function shouldDeletePreservingMedia(): bool;

    /**
     * Cache the media on the object.
     *
     * @param string $collectionName
     *
     * @return mixed
     *
     */
    public function loadMedia(string $collectionName);

    public function addMediaConversion(string $name): Conversion;

    public function registerMediaConversions(\App\Models\Media $media = null): void;

    public function registerMediaCollections(): void;

    public function registerAllMediaConversions(): void;
}
