<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\CategoryEdit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\AddCateRequest;
use App\Http\Requests\EditCateRequest;
use Session;
use DB;

class CategoryController extends Controller
{
    /**
     * @var Category
     */
    protected $category;

    /**
     * CategoryController constructor.
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * List categories
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $data['categories'] = $this->category->get(['id', 'name', 'icon']);
        return view('admin.category.list', $data);
    }

    /**
     * Function update categories
     *
     * @param CategoryEdit $request
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCategory(CategoryEdit $request, Category $category)
    {
        $category->fill($request->only('name', 'slug', 'icon'));
        $category->slug = str_slug(($request->name));
        $category->save();
        return response()->json($category, 200);
    }
}
