<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class DocsController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index(string $locale, string $slug): Factory|View|Application
    {
        return view('posts.index');
    }
}
