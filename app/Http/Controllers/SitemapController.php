<?php

namespace App\Http\Controllers;

use AaronDDM\XMLBuilder\Exception\XMLBuilderException;
use AaronDDM\XMLBuilder\Writer\XMLWriterService;
use AaronDDM\XMLBuilder\XMLBuilder;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Traits\Locale;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    use Locale;

    /**
     * Show the application dashboard.
     * @throws XMLBuilderException
     */
    public function index(): Response|Application|ResponseFactory
    {
        $posts = Post::query()->orderBy('created_at')->orderBy('updated_at')->get();
        $tags = Tag::query()->orderBy('name')->get();

        $locales = config('locales');

        $categories = Category::query()->orderBy('title')->get();

        $xmlWriterService = new XMLWriterService();
        $xmlBuilder = new XMLBuilder($xmlWriterService);
        $xmlArray = $xmlBuilder
            ->createXMLArray()
            ->start('urlset', [
                'xmlns' => 'http://www.sitemaps.org/schemas/sitemap/0.9',
                'xmlns:xsi' => "http://www.w3.org/2001/XMLSchema-instance",
                'xsi:schemaLocation' => "http://www.sitemaps.org/schemas/sitemap/0.9",
                'xmlns:xhtml' => 'http://www.w3.org/1999/xhtml'
            ]);

        if (count($posts) > 0) {

            foreach ($posts as $post) {
                $xmlArray = $xmlArray->start('url');

                $post = $post->toArray();
                $categorySlug = $post['slug'];

                if (isset($categorySlug['ru'])) {
                    $xmlArray->add('loc',
                        routeLink('posts.show', ['slug' => $categorySlug['ru'], 'locale' => 'ru'], true));
                    unset($categorySlug['ru']);

                    foreach ($locales as $alias => $locale) {
                        if (isset($categorySlug[$alias])) {
                            $attributes = [
                                'rel' => 'alternate',
                                'hreflang' => $alias,
                                'href' => routeLink('posts.show', ['slug' => $categorySlug[$alias], 'locale' => $alias], true)
                            ];

                            $xmlArray->add('xhtml:link', attributes: $attributes);
                        }
                    }
                }

                $xmlArray->add('lastmod', !empty($post['updated_at']) ? $post['updated_at'] : $post['created_at']);
                $xmlArray->add('changefreq', 'daily');
                $xmlArray = $xmlArray->end();
            }
        }

        if (count($categories) > 0) {

            /** @var Category $category */
            foreach ($categories as $category) {
                $xmlArray = $xmlArray->start('url');

                $categoryArray = $category->toArray();
                $categorySlug = $categoryArray['slug'];

                if (isset($categorySlug['ru'])) {
                    $xmlArray->add('loc', routeLink('categories.show', [$category->getPathByLocale('ru'),
                        'locale' => 'ru'], true));

                    unset($categorySlug['ru']);

                    foreach ($locales as $alias => $locale) {
                        if (isset($categorySlug[$alias])) {

                            $attributes = [
                                'rel' => 'alternate',
                                'hreflang' => $alias,
                                'href' => routeLink('categories.show', [$category->getPathByLocale($alias),
                                    'locale' => $alias], true)
                            ];

                            $xmlArray->add('xhtml:link', attributes: $attributes);
                        }
                    }
                }

                $xmlArray->add('lastmod', !empty($categoryArray['updated_at']) ?
                    $categoryArray['updated_at'] : $categoryArray['created_at']);

                $xmlArray->add('changefreq', 'daily');
                $xmlArray = $xmlArray->end();
            }
        }

        if (count($tags) > 0) {
            foreach ($tags as $tag) {
                $tagArray = $tag->toArray();

                $tagSlug = $tagArray['slug'];

                if (isset($tagSlug['ru'])) {
                    $xmlArray = $xmlArray->start('url');

                    $xmlArray->add('loc',
                        routeLink('tags.show', ['slug' => $tagSlug['ru'], 'locale' => 'ru'], true));
                    unset($tagSlug['ru']);

                    foreach ($locales as $alias => $locale) {
                        if (isset($tagSlug[$alias])) {
                            $attributes = [
                                'rel' => 'alternate',
                                'hreflang' => $alias,
                                'href' => routeLink('tags.show', ['slug' => $tagSlug[$alias], 'locale' => $alias], true)
                            ];

                            $xmlArray->add('xhtml:link', attributes: $attributes);
                        }
                    }


                    $xmlArray->add('lastmod', !empty($tagArray['updated_at']) ? $tagArray['updated_at'] : $tagArray['created_at']);
                    $xmlArray->add('changefreq', 'daily');
                    $xmlArray = $xmlArray->end();
                }
            }
        }

        \Debugbar::disable();

        return response($xmlBuilder->getXML())->header('Content-Type', 'application/xml');
    }
}
