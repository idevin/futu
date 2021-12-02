<?php


namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
     * @param string|null $locale
     * @param string $type
     * @return Builder
     */
    public function scopeByLocale(Builder $query, string $locale = null, string $type = ''): Builder
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

    public function scopeTagCloud(Builder $query, string $locale = null, string $type = ''): Builder
    {
        $query = $this->scopeByLocale($query, $locale, $type);

        $query->select(DB::raw("COUNT(taggables.taggable_type) AS count"), 'tags.id', 'tags.name', 'tags.slug')
            ->groupBy('taggables.tag_id', 'tags.id', 'tags.name', 'tags.slug');

        return $query;
    }

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'taggables', 'tag_id', 'taggable_id');
    }

    public function docs(): BelongsToMany
    {
        return $this->belongsToMany(Doc::class, 'taggables', 'tag_id', 'taggable_id');
    }

    public function taggables(): HasMany
    {
        return $this->hasMany(Taggable::class, 'tag_id');
    }
}
