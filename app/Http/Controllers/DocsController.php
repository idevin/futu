<?php

namespace App\Http\Controllers;

use App\Models\Doc;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DocsController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index(string $locale, string $slug): Factory|View|Application
    {
        return view('posts.index');
    }

    /**
     * Display the specified resource.
     * @param $locale
     * @param $alias
     * @return \Illuminate\View\View|RedirectResponse
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function show($locale, $alias): View|RedirectResponse
    {

        if (!in_array($locale, array_keys(config('locales')))) {
            throw new NotFoundHttpException();
        }

        $doc = Doc::usingLocale($locale)->query()->where('alias', 'regexp', parseSlug($alias))->first();

        if (!$doc) {
            throw new NotFoundHttpException();
        }

        $postArray = $doc->toArray();

        if (empty($postArray['alias'][$locale])) {
            throw  new NotFoundHttpException();
        }

        if ($postArray['alias'][$locale] != $alias) {
            app()->setLocale($locale);
            return redirect()->to(routeLink('docs.show', ['alias' => $postArray['alias'][$locale], 'locale' => $locale]));
        }

        return view('docs.show', [
            'doc' => $doc,
            'tags' => $doc->tags
        ]);
    }
}
