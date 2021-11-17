<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Traits\Locale;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
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
        $tag = Tag::query()->bySlug($slug, $locale)->withType(Post::class)->first();

        if(!$tag) {
            return throw new NotFoundHttpException();
        }

        $posts = $tag->posts()->paginate(10);

        return view('tags.show', ['posts' => $posts, 'tag' => $tag]);
    }
}
