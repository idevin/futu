<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaLibrary;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Traits\Category;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TagController extends Controller
{
    use Category;

    /**
     * Show the application posts index.
     */
    public function index(): View
    {
      $tags = Tag::usingLocale(config('app.default_locale'))->paginate(50);
        $types = Tag::getTypes();

        return view('admin.tags.index', [
            'tags' => $tags
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

        return view('admin.tags.edit', [
            'post' => $post,
            'tags' => $tags,
            'users' => User::authors()->pluck('name', 'id'),
            'media' => MediaLibrary::first()->media()->get()->pluck('name', 'id'),
            'categories' => self::treeSelect($locale)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($locale, Request $request): View
    {

        return view('admin.tags.create', [
            'users' => User::authors()->pluck('name', 'id'),
            'media' => MediaLibrary::first()->media()->get()->pluck('name', 'id'),
            'categories' => self::treeSelect($locale)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($locale, Request $request): RedirectResponse
    {
        $attributes = $request->only(['posted_at', 'author_id', 'thumbnail_id', 'category_id']);
        $attributes['posted_at'] = Carbon::parse($attributes['posted_at']);
        $post = new Post($attributes);

        $this->postTranslations($post, $request);

        $post->save();
        $post->saveTags($request);

        return redirect()->to(routeLink('admin.tags.edit', $post))->withSuccess(__('posts.created', [], $locale));
    }

    public function postTranslations($post, Request $request)
    {
        $slugs = [];
        foreach ($request->input('slug') as $locale => $slug) {
            if (empty($slug)) {
                $slug = $request->input('title')[$locale];
            }
            $slugs[$locale] = Str::slug($slug, '-', $locale);
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
        $post->update($request->only(['posted_at', 'author_id', 'thumbnail_id', 'category_id']));

        $post->saveTags($request);

        return redirect()->to(routeLink('admin.tags.edit', $post))->withSuccess(__('posts.updated', [], $locale));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($locale, Post $post)
    {
        $post->delete();

        return redirect()->to(routeLink('admin.tags.index'))->withSuccess(__('posts.deleted', [], $locale));
    }
}
