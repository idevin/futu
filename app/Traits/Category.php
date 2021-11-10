<?php


namespace App\Traits;


use App\Models\Category as CategoryModel;

trait Category
{
    public static function treeSelect($locale, $category = null): array
    {
        $categories = CategoryModel::roots();

        if ($category) {
            $categories = $categories->whereNotIn('id', [$category->id]);
        }

        $categories = $categories->get();

        CategoryModel::tree($categories, $treeData, $select, $locale);

        return [null => __('Select category...', [], $locale)] + ($select ?? []);
    }
}
