<?php

namespace App\Observers;

use App\Models\Category;

class CategoryObserver
{
    /**
     * Listen to the User creating event.
     */
    public function updated(Category $category): void
    {

    }
}
