<?php

namespace App\Http\ViewComposers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class CategoryComposers extends Controller
{
    public function __construct(Category $category)
    {
        $this->view_categories = $category->orderBy('id', 'ASC')->get();
    }

    public function compose(View $view)
    {
        $view->with('view_categories', $this->view_categories);
    }
}
