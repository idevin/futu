<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Tags\Tag as TagBase;

/**
 * @method bySlug(string $alias, $locale = null)
 * @method static containing(mixed $int, int|string $int1)
 * @method getQuery()
 * @method static byLocale(mixed $get)
 */
class Tag extends TagBase
{
    /**
     * @param Builder $query
     * @param string $locale
     * @param string $type
     * @return Builder
     */
    public function scopeByLocale(Builder $query, string $locale, string $type = ''): Builder
    {
        $locale = $locale ?? app()->getLocale();

        $query = $query->whereRaw('lower(' . $this->getQuery()->getGrammar()->wrap('slug->' . $locale) . ') IS NOT NULL')
            ->join('taggables', 'tags.id', '=', 'taggables.tag_id')->ordered();

        if (!empty($type)) {
            $query = $query->where('tags.type', '=', $type);
        }

        return $query;
    }

    public function scopeBySlug(Builder $query, string $slug, $locale = null): Builder
    {
        $locale = $locale ?? app()->getLocale();

        return $query->whereRaw('lower(' . $this->getQuery()->getGrammar()->wrap('slug->' . $locale) . ') regexp ?',
            [parseSlug(mb_strtolower($slug))]);
    }

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'taggables', 'tag_id', 'taggable_id');
    }
}
