<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Localization
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
        $requestParams = request()->route()->parameters();

        if(!isset($requestParams['locale'])) {
            $requestParams['locale'] = $request->get('locale');
        }

        if(isset($requestParams['locale']) && !in_array($requestParams['locale'], array_keys(config('locales')))) {
            session()->put('locale', app()->getLocale());
            app()->setlocale(app()->getLocale());
            return throw new NotFoundHttpException();
        }

        if (session()->has('locale')) {
            if (isset($requestParams['locale']) && $requestParams['locale'] != session()->get('locale')) {
                app()->setlocale($requestParams['locale']);
                session()->put('locale', $requestParams['locale']);
            }

            app()->setlocale(session()->get('locale'));
        } else {
            app()->setlocale(app()->getLocale());
            if(isset($requestParams['locale'])) {
                session()->put('locale', $requestParams['locale']);
            } else {
                session()->put('locale', app()->getLocale());
            }
        }

        return $next($request);
    }
}
