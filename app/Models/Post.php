<?php

namespace App\Models;

use App\Concern\Likeable;
use App\Scopes\PostedScope;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\Pure;
use Spatie\Tags\HasTags;
use Spatie\Translatable\HasTranslations;

/**
 * @property array title
 * @property array slug
 * @property int thumbnail_id
 * @property string content
 * @method static firstOrCreate(array $array, array $array1)
 */
class Post extends Model
{
    use HasFactory, Likeable, HasTranslations, HasTags;

    public bool $timestamps = true;

    public array $casts = [
        'title' => 'array',
        'content' => 'array',
        'meta_title' => 'array',
        'meta_description' => 'array',
        'meta_keywords' => 'array',
        'slug' => 'array'
    ];

    public array $translatable = ['title', 'content', 'slug', 'meta_title', 'meta_description', 'meta_keywords',
        'description'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author_id',
        'category_id',
        'title',
        'content',
        'description',
        'posted_at',
        'slug',
        'thumbnail_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'created_at',
        'updated_at',
        'show_comments_count',
        'show_likes_count',
        'show_date',
        'show_author',
        'allow_comments'
    ];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected array $dates = [
        'posted_at'
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
            return 'slug';
        } elseif (request()->expectsJson()) {
            return 'id';
        }

        return 'id';
    }

    /**
     * Scope a query to search posts
     */
    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        if ($search) {
            return $query->where('title', 'LIKE', "%{$search}%")->orWhere('content' , 'LIKE', "%{$search}%")
                ->orWhere('description' , 'LIKE', "%{$search}%");
        }

        return $query;
    }

    /**
     * Scope a query to order posts by latest posted
     */
    public function scopeLatest(Builder $query): Builder
    {
        return $query->orderBy('posted_at', 'asc');
    }

    /**
     * Scope a query to only include posts posted last month.
     */
    public function scopeLastMonth(Builder $query, int $limit = 5): Builder
    {
        return $query->whereBetween('posted_at', [carbon('1 month ago'), now()])
            ->latest()
            ->limit($limit);
    }

    /**
     * Scope a query to only include posts posted last week.
     */
    public function scopeLastWeek(Builder $query): Builder
    {
        return $query->whereBetween('posted_at', [carbon('1 week ago'), now()])
            ->latest();
    }

    /**
     * Return the post's author
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Return the post's thumbnail
     */
    public function thumbnail(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }

    /**
     * Return the post's comments
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
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

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Prepare a date for array / JSON serialization.
     */
    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}
