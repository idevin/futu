<?php


namespace App\Traits;


use App\Models\Category;
use App\Models\Post;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait Locale
{
    public static function categoriesShow($route, $locale, $backUrl): array
    {
        $path = explode('/', $backUrl['path']);

        $countDashes = substr_count($route->uri, '/');
        $path = array_values(array_filter($path));
        $spliced = last(array_splice($path, $countDashes));
        $category = Category::usingLocale($locale)->where('slug', 'regexp', parseSlug($spliced))->first();

        if (!$category) {
            throw new NotFoundHttpException();
        }

        return array_merge($route->parameters, ['locale' => $locale, 'slug_path' => $category->slug_path]);
    }

    /**
     * @param $route
     * @return mixed
     */
    public static function getAction($route): mixed
    {
        return $route->getAction()['as'];
    }

    public static function postsShow($route, $locale, $backUrl): array
    {
        $slug = last(explode('/', $backUrl['path']));
        $regexp = parseSlug($slug);

        $post = Post::usingLocale($locale)->where('slug', 'regexp', $regexp)->first();

        return array_merge($route->parameters, ['locale' => $locale, 'slug' => $post->slug]);
    }
}
