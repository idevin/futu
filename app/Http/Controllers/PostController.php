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

class PostController extends Controller
{
    use Locale;

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function switchLocale($locale): string
    {
        $defaultRedirect = redirect()->to('/') . app()->getLocale();
        $redirect = redirect()->back();
        $backUrl = $redirect->getTargetUrl();

        if (in_array($locale, array_keys(config('locales')))) {
            session()->put('locale', $locale);

            if (request()->fullUrl() === $backUrl) {
                return $defaultRedirect;
            }
            $url = parse_url($backUrl);
            if (preg_match('#/locale(.*)#', $url['path']) == 0) {

                $path = $url['path'];
                $createdRequest = request()->create($path);

                $route = app('router')->getRoutes()->match($createdRequest);
                $action = self::getAction($route);
                $methodParts = explode('.', $action);

                $method = implode('', array_map(function ($part, $i) {
                    return $i !== 0 ? ucfirst($part) : $part;
                }, $methodParts, array_keys($methodParts)));

                if (method_exists($this, $method)) {
                    $route->parameters = self::{$method}($route, $locale, $url);
                } else {
                    $route->parameters['locale'] = $locale;
                }

                return redirect(routeLink($action, $route->parameters));
            } else {
                return $defaultRedirect;
            }

        } else {

            return $defaultRedirect;
        }
    }

    public function setLocale(): RedirectResponse
    {
        if (in_array(session()->get('locale'), array_keys(config('locales')))) {
            return redirect()->to('/' . session()->get('locale'));
        } else {
            return redirect()->to('/' . app()->getLocale());
        }
    }

    /**
     * Show the application dashboard.
     */
    public function index($locale): View
    {
        $posts = Post::usingLocale($locale)->with('author', 'likes')
            ->withCount('comments', 'thumbnail', 'likes')->latest()->take(3)->get();

        $posts = $posts?->split(2);

        $tags = Tag::byLocale(session()->get('locale'))->get();

        $categories = Category::usingLocale($locale)->roots()->orderBy('title')->without('children')
            ->select('id', 'title')
            ->get()->toArray();

        return view('posts.index', [
            'posts' => $posts,
            'tags' => $tags,
            'categories' => $categories
        ]);
    }

    /**
     * Display the specified resource.
     * @param $locale
     * @param Category $category
     * @param $slug
     * @return View|RedirectResponse
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function show($locale, Category $category, $slug): View|RedirectResponse
    {
        if (!in_array($locale, array_keys(config('locales')))) {
            throw new NotFoundHttpException();
        }

        $post = Post::usingLocale($locale)->where('slug', 'regexp', parseSlug($slug))->first();

        if (!$post) {
            return app(CategoryController::class)->show($locale, $slug);
        }

        $postArray = $post->toArray();

        if (empty($postArray['slug'][$locale])) {
            throw  new NotFoundHttpException();
        }

        if ($postArray['slug'][$locale] != $slug) {
            app()->setLocale($locale);
            return redirect()->to(routeLink('posts.show', ['slug' => $postArray['slug'][$locale], 'locale' => $locale]));
        }

        $post->comments_count = $post->comments()->count();
        $post->likes_count = $post->likes()->count();

        return view('posts.show', [
            'post' => $post,
            'tags' => $post->tags
        ]);
    }

    public function all($locale): Factory|View|Application
    {
        $postsPaginated = Post::usingLocale($locale)->with('author', 'likes')
            ->withCount(['comments', 'thumbnail', 'likes', 'category'=> function($query){
                $query->orderBy('title');
            }])->latest()->paginate(6);

        $posts = $postsPaginated?->split(2);

        $tags = Tag::byLocale(app()->getLocale())->orderBy('slug')->get();

        return view('posts.all', [
            'posts' => $posts,
            'tags' => $tags,
            'postsPaginated' => $postsPaginated
        ]);
    }

    public function search($locale, Request $request): Factory|\Illuminate\Contracts\View\View|Application
    {
        $q = $request->input('q');

        if (empty($q)) {
            return throw new NotFoundHttpException();
        }

        $posts = Post::usingLocale($locale)->search($q)->with('author', 'likes')
            ->withCount('comments', 'thumbnail', 'likes')->latest()->paginate(9)
            ->setPath(routeLink('posts.search'));

        $posts->appends(['q' => $request->get('q')]);

        return view('posts.search', [
            'posts' => $posts
        ]);
    }
}
