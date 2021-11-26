<?php

namespace App\View\Components;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FooterCategories extends Component
{
    /**
     * Create a new component instance.
     *
     */
    public function __construct()
    {

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|string|Closure
    {
        $categories = Category::usingLocale(app()->getLocale())
            ->orderBy('weight')->get()->makeHidden(['weight', 'title', 'slug_path']);

        return view('components.footer_categories', ['categories' => $categories]);
    }
}
