<?php

namespace App\View\Components;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Vicklr\MaterializedModel\HierarchyCollection;

class NavCategories extends Component
{
    private HierarchyCollection $categories;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->categories = Category::usingLocale(app()->getLocale())->roots()
            ->orderBy('weight')->get(['id', 'title']);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|string|Closure
    {
        return view('components.nav_categories', ['categories' => $this->categories]);
    }
}
