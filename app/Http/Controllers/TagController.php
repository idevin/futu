<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TagController extends Controller
{


    /**
     * Display the specified resource.
     * @param $locale
     * @param $slug
     * @return View
     */
    public function show($locale, $slug): View
    {
        $tag = Tag::query()->bySlug($slug, $locale)->first();

        if (!$tag) {
            return throw new NotFoundHttpException();
        }

        $tagGroups = [];
        if (count($tag->taggables) > 0) {
            foreach ($tag->taggables as $taggable) {
                $tagGroups[$taggable->taggable_type][$taggable->taggable_id] =
                    app($taggable->taggable_type)->usingLocale($locale)->find($taggable->taggable_id);
            }
        }

        return view('tags.show', compact('tagGroups', 'tag'));
    }

    public function index($locale): Factory|\Illuminate\Contracts\View\View|Application
    {
        $tags = Tag::query()->tagCloud($locale)->get()->shuffle();

        return view('tags.index', compact('tags'));
    }
}
