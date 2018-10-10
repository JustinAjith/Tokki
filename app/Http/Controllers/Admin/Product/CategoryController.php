<?php

namespace App\Http\Controllers\Admin\Product;

use App\Category;
use App\Repositories\Admin\CategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    protected $category;
    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $categories = Category::with('subCategory')->get();
        return view('admin.category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        return $this->category->store($request);
    }

    public function storeSubCategory(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'name' => 'required'
        ]);
        return $this->category->storeSubCategory($request);
    }
}
