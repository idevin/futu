<?php

namespace App\Http\Middleware;

use App;
use App\Models\Category;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Categories
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $categories = Category::usingLocale(config('app.locale'))->roots()->get()->toArray();
        view()->share('categories', $categories);

        return $next($request);
    }
}
