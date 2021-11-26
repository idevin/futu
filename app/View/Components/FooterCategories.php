<?php

namespace App\View\Components;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class FooterCategories extends Component
{
    private Model $categories;

    /**
     * Create a new component instance.
     *
     * @param Model $categories
     */
    public function __construct(Model $categories)
    {
        $this->categories = Category::usingLocale(app()->getLocale())->orderBy('weight')
            ->makeHidden(['weight', 'title', 'slug_path']);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|string|Closure
    {
        return view('components.footer_categories', ['categories' => $this->categories]);
    }
}
