<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\Category as CategoryTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{
    use CategoryTrait;

    /**
     * Show the application categories index.
     */
    public function index(): View
    {
        $categories = Category::usingLocale(config('app.default_locale'))->roots()->withCount('posts')->get();

        return view('admin.categories.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Display the specified resource edit form.
     */
    public function edit($locale, Category $category): View
    {
        return view('admin.categories.edit', [
            'category' => $category,
            'categories' => self::treeSelect($locale, $category)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($locale): View
    {
        $categories = Category::roots()->get();
        Category::tree($categories, $treeData, $select);

        return view('admin.categories.create', [
            'categories' => [null => __('Select category...', [], $locale)] + ($select ?? [])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($locale, Request $request): RedirectResponse
    {
        $category = new Category();

        $this->categoryTranslations($category, $request);

        $category->save();

        if (!empty($request->input('parent_id'))) {
            $category->makeChildOf($request->input('parent_id'));
        }

        return redirect()->to(routeLink('admin.categories.edit', $category))->withSuccess(__('categories.created'));
    }

    public function categoryTranslations($category, Request $request)
    {
        $slugs = [];

        foreach ($request->input('slug') as $locale => $slug) {
            if(empty($slug)) {
                $slug = $request->input('title')[$locale];
            }
            $slugs[$locale] = Str::slug($slug, '-', $locale);
        }

        $category->setTranslations('title', $request->input('title'));
        $category->setTranslations('slug', $slugs);
        $category->setTranslations('meta_title', $request->input('meta_title'));
        $category->setTranslations('meta_description', $request->input('meta_description'));
        $category->setTranslations('meta_keywords', $request->input('meta_keywords'));
        $category->setTranslations('content', $request->input('content'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($locale, Request $request, Category $category): RedirectResponse
    {
        $this->categoryTranslations($category, $request);

        if (!empty($request->input('parent_id'))) {
            $category->makeChildOf($request->input('parent_id'));
        }

        $category->update();

        return redirect()->to(routeLink('admin.categories.edit', $category))
            ->withSuccess(__('categories.updated'), [], $locale);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($locale, Category $category)
    {
        $category->delete();

        return redirect()->to(routeLink('admin.categories.index'))->withSuccess(__('categories.deleted'));
    }
}
