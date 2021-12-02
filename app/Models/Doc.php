<?php

namespace App\Models;

use App\Concern\Likeable;
use App\Scopes\PostedScope;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\Pure;
use Spatie\Tags\HasTags;
use Spatie\Translatable\HasTranslations;

/**
 * @property array title
 * @property array slug
 * @property int thumbnail_id
 * @property string content
 * @property mixed $media_library_id
 * @method static firstOrCreate(array $array, array $array1)
 */
class Doc extends Model
{
    use HasFactory, Likeable, HasTranslations, HasTags;

    public static string $route = 'docs.show';
    public $timestamps = true;
    public $casts = [
        'title' => 'array',
        'content' => 'array',
        'meta_title' => 'array',
        'meta_description' => 'array',
        'meta_keywords' => 'array',
        'alias' => 'array',
        'description' => 'array'
    ];

    public array $translatable = ['title', 'content', 'alias', 'meta_title', 'meta_description', 'meta_keywords',
        'description'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'description',
        'alias',
        'thumbnail_id',
        'media_library_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'created_at',
        'updated_at'
    ];

    public static function fromCategory(int $categoryId = null, int $postsLimit = 3,
                                        int $parentId = null, array &$posts = []): array
    {
        $categories = Category::usingLocale(session()->get('locale'))->query();

        if ($categoryId) {
            $categories = $categories->whereId($categoryId);
        }

        $categories = $categories->get();

        if (!empty($categories)) {
            foreach ($categories as $category) {
                $allPosts = $category->posts()->latest()->take($postsLimit)->get();

                if ($category->parent_id == null) {

                    $parentId = $category->id;
                    $posts[$category->id] = ['category' => $category, 'posts' => collect()];

                    $allPosts->each(function ($post) use (&$posts, $category) {
                        $posts[$category->id]['posts'][$post->id] = $post;
                    });
                }

                if ($parentId) {
                    $postsCount = $posts[$parentId]['posts']->count();

                    if ($postsCount < $postsLimit) {
                        if (!empty($category['children'])) {
                            foreach ($category['children'] as $child) {
                                $allPosts = $child->posts()->latest()->take($postsLimit - $postsCount)->get();

                                $allPosts->each(function ($post) use (&$posts, $parentId, $postsLimit) {
                                    if ($posts[$parentId]['posts']->count() != $postsLimit) {
                                        $posts[$parentId]['posts'][$post->id] = $post;
                                    }
                                });

                                self::fromCategory($child->id, $postsLimit, $parentId, $posts);
                            }
                        }
                    }
                }
            }
        }

        return $posts;
    }

    /**
     * The "booting" method of the model.
     */
    protected static function boot(): void
    {
        parent::boot();
        static::addGlobalScope(new PostedScope);

        static::deleting(function (self $doc) {
            Taggable::query()->where('taggable_type', get_class($doc))
                ->where('taggable_id', $doc->id)->delete();
        });
    }

    public function saveTags($request): void
    {
        if (!empty($request->input('tags'))) {
            $newtags = [];
            foreach ($request->input('tags') as $locale => $tagString) {

                if (!empty($tagString)) {
                    if (is_string($tagString)) {
                        $tagNames = explode(',', $tagString);
                        if (!empty($tagNames)) {
                            foreach ($tagNames as $i => $tag) {
                                $newtags[$i][$locale] = $tag;
                            }
                        }
                    }
                }
            }

            if (!empty($newtags)) {
                foreach ($newtags as $newtag) {

                    $tag = Tag::containing(array_values($newtag)[0], array_keys($newtag)[0])->first();

                    if (!$tag) {
                        $tag = Tag::findOrCreate(array_values($newtag)[0], get_class($this), array_keys($newtag)[0]);
                    }

                    foreach ($newtag as $locale => $item) {
                        $tag->setTranslation('name', $locale, $item);
                    }

                    $this->attachTag($tag, get_class($this));
                }
            }
        }
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        if (!request()->routeIs('admin.*') && !request()->expectsJson()) {
            return 'alias';
        } elseif (request()->expectsJson()) {
            return 'id';
        }

        return 'id';
    }

    /**
     * Scope a query to order posts by latest posted
     */
    public function scopeLatest(Builder $query): Builder
    {
        return $query->orderBy('created_at');
    }


    /**
     * Return the post's thumbnail
     */
    public function thumbnail(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }

    /**
     * return the excerpt of the post content
     */
    #[Pure]
    public function excerpt(int $length = 50): string
    {
        return Str::limit($this->content, $length);
    }

    /**
     * return true if the post has a thumbnail
     */
    public function hasThumbnail(): bool
    {
        return filled($this->thumbnail_id);
    }

    public function hasCollection(): bool
    {
        return filled($this->media_library_id);
    }

    public function library(): BelongsTo
    {
        return $this->belongsTo(MediaLibrary::class, 'media_library_id');
    }

    /**
     * Prepare a date for array / JSON serialization.
     */
    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}
