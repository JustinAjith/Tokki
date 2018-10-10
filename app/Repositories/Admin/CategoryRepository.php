<?php
namespace App\Repositories\Admin;

use App\Category;
use App\SubCategory;
use Illuminate\Http\Request;

class CategoryRepository
{
    protected $category;
    protected $subCategory;
    public function __construct(Category $category = null, SubCategory $subCategory = null)
    {
        $this->category = $category ?? new Category();
        $this->subCategory = $subCategory ?? new SubCategory();
    }

    public function store(Request $request)
    {
        $data = $this->category->fill($request->toArray());
        $data->save();
        return ['success'=>true];
    }

    public function getRefNo($id)
    {
        $count = $this->subCategory->count();
        $ref = rand(11111111, 99999999).$id.($count+1);
        return $ref;
    }

    public function storeSubCategory(Request $request)
    {
        $refId = $this->getRefNo($request->category_id);
        $data = $this->subCategory->fill($request->toArray());
        $data->setAttribute('ref_id', $refId);
        $data->save();
        return ['success'=>true];
    }
}