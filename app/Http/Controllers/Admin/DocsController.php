<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doc;
use App\Models\Media;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DocsController extends Controller
{
    /**
     * Show the application posts index.
     */
    public function index(): View
    {
        return view('admin.docs.index', [
            'docs' => Doc::usingLocale(app()->getLocale())->latest()->paginate(10)
        ]);
    }

    /**
     * Display the specified resource edit form.
     */
    public function edit($locale, Doc $doc): View
    {
        $tags = [];

        foreach (array_keys(config('locales')) as $locale) {
            $tags[$locale] = $doc->tags->map(function ($tag) use ($locale) {
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

        return view('admin.docs.edit', [
            'doc' => $doc,
            'tags' => $tags,
            'media' => Media::query()->defaultCollection()->orderBy('name')->pluck('name', 'id')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($locale, Request $request): View
    {
        return view('admin.docs.create', [
            'media' => Media::query()->defaultCollection()->orderBy('name')->pluck('name', 'id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($locale, Request $request): RedirectResponse
    {

        $attributes = $request->only(['title', 'content', 'description',
            'alias', 'thumbnail_id', 'meta_title', 'meta_description', 'meta_keywords',
        ]);

        $doc = new Doc($attributes);

        $this->docsTranslations($doc, $request);

        $doc->save();
        $doc->saveTags($request);

        return redirect()->to(routeLink('admin.docs.edit', $doc))->withSuccess(__('docs.created', [], $locale));
    }

    public function docsTranslations($doc, Request $request)
    {
        $aliases = [];
        foreach ($request->input('alias') as $locale => $alias) {
            if (empty($alias)) {
                $alias = $request->input('title')[$locale];
            }
            $aliases[$locale] = slugify($alias);
        }

        $doc->setTranslations('title', $request->input('title'));
        $doc->setTranslations('description', $request->input('description'));
        $doc->setTranslations('content', $request->input('content'));
        $doc->setTranslations('alias', $aliases);
        $doc->setTranslations('meta_title', $request->input('meta_title'));
        $doc->setTranslations('meta_description', $request->input('meta_description'));
        $doc->setTranslations('meta_keywords', $request->input('meta_keywords'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($locale, Request $request, Doc $doc): RedirectResponse
    {
        $this->docsTranslations($doc, $request);
        $doc->update();

        $doc->saveTags($request);

        return redirect()->to(routeLink('admin.docs.edit', $doc))->withSuccess(__('docs.updated', [], $locale));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($locale, Post $post)
    {
        $post->delete();

        return redirect()->to(routeLink('admin.docs.index'))->withSuccess(__('docs.deleted', [], $locale));
    }
}
