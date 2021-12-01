<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Traits\Locale;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ContactsController extends Controller
{
    use Locale;

    /**
     * Show the application dashboard.
     */
    public function index($locale): View
    {
        $posts = Post::usingLocale($locale)->with('author', 'likes')
            ->withCount('comments', 'thumbnail', 'likes')->latest()->take(3)->get();

        $posts = $posts?->split(2);

        $tags = Tag::byLocale(app()->getLocale())->get();

        $categories = Category::usingLocale($locale)->roots()->orderBy('title')->without('children')
            ->select('id', 'title')
            ->get()->toArray();

        return view('posts.index', [
            'posts' => $posts,
            'tags' => $tags,
            'categories' => $categories
        ]);
    }
}
