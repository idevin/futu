<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\MediaLibrary;
use App\Models\Post;
use App\Models\User;
use App\Traits\Category;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    use Category;

    /**
     * Show the application posts index.
     */
    public function index(): View
    {

        return view('admin.posts.index', [
            'posts' => Post::usingLocale(config('app.default_locale'))->withCount('comments', 'likes')
                ->with('author')->latest()->paginate(50)
        ]);
    }

    /**
     * Display the specified resource edit form.
     */
    public function edit($locale, Post $post): View
    {
        $tags = [];

        foreach (array_keys(config('locales')) as $locale) {
            $tags[$locale] = $post->tags->map(function ($tag) use ($locale) {
                return $tag->setLocale($locale)->name;
            })->toArray();
        }

        foreach ($tags as $l => $tag) {
            foreach ($tag as $i => $item) {
                if (empty($item)) {
                    unset($tags[$l][$i]);
                }
            }
        }

        $collections = [null => 'Select collection...'] +
            MediaLibrary::query()->orderBy('collection_name')->pluck('collection_name', 'id')->toArray();

        return view('admin.posts.edit', [
            'post' => $post,
            'tags' => $tags,
            'categories' => self::treeSelect(app()->getLocale()),
            'users' => User::authors()->pluck('name', 'id'),
            'collections' => $collections,
            'media' => Media::query()->defaultCollection()->orderBy('name')->pluck('name', 'id')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($locale, Request $request): View
    {

        $collections = [null => 'Select collection...'] +
            MediaLibrary::query()->orderBy('collection_name')->pluck('collection_name', 'id')->toArray();

        return view('admin.posts.create', [
            'users' => User::authors()->pluck('name', 'id'),
            'collections' => $collections,
            'categories' => self::treeSelect($locale),
            'media' => Media::query()->defaultCollection()->orderBy('name')->pluck('name', 'id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($locale, Request $request): RedirectResponse
    {

        $attributes = $request->only(['author_id', 'category_id', 'title', 'content', 'description', 'posted_at',
            'slug', 'thumbnail_id', 'media_library_id', 'meta_title', 'meta_description', 'meta_keywords',
            'show_comments_count', 'show_likes_count', 'show_date', 'show_author', 'allow_comments', 'year'
        ]);

        $attributes['posted_at'] = Carbon::parse($attributes['posted_at']);
        $post = new Post($attributes);

        $this->postTranslations($post, $request);

        $post->save();
        $post->saveTags($request);

        return redirect()->to(routeLink('admin.posts.edit', $post))->withSuccess(__('posts.created', [], $locale));
    }

    public function postTranslations($post, Request $request)
    {

        $slugs = [];
        foreach ($request->input('slug') as $locale => $slug) {
            if (empty($slug)) {
                $slug = $request->input('title')[$locale];
            }
            $slugs[$locale] = slugify($slug);
        }

        $post->setTranslations('title', $request->input('title'));
        $post->setTranslations('description', $request->input('description'));
        $post->setTranslations('content', $request->input('content'));
        $post->setTranslations('slug', $slugs);
        $post->setTranslations('meta_title', $request->input('meta_title'));
        $post->setTranslations('meta_description', $request->input('meta_description'));
        $post->setTranslations('meta_keywords', $request->input('meta_keywords'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($locale, Request $request, Post $post): RedirectResponse
    {
        $this->postTranslations($post, $request);

        $post->update();

        $post->saveTags($request);

        return redirect()->to(routeLink('admin.posts.edit', $post))->withSuccess(__('posts.updated', [], $locale));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($locale, Post $post)
    {
        $post->delete();

        return redirect()->to(routeLink('admin.posts.index'))->withSuccess(__('posts.deleted', [], $locale));
    }
}
