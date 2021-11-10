<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index(Request $request, $locale): View
    {
        return view('categories.index', [
            'posts' => Post::usingLocale($locale)->search($request->input('q'))
                ->with('author', 'likes')
                ->withCount('comments', 'thumbnail', 'likes')
                ->latest()
                ->paginate(20)
        ]);
    }

    /**
     * Display the specified resource.
     * @param $locale
     * @param $path
     * @return View
     */
    public function show($locale, $path): View
    {
        $lastPath = last(explode('/', $path));

        $category = Category::usingLocale($locale)->where('slug', 'regexp', parseSlug($lastPath))->first();



        if (!$category || $path . '/' !== $category->slug_path) {
            throw new NotFoundHttpException();
        }

        return view('categories.show', [
            'category' => $category,
            'posts' => $category->posts()->with('author', 'likes')->withCount('comments', 'thumbnail', 'likes')
                ->latest()->paginate(20)
        ]);
    }
}
