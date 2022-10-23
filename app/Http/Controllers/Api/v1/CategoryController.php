<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCategoryFormRequest;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    private $category, $totalPage = 5;

    public function __construct(Category $category)
    {
        $this->category = $category;
        $this->middleware('auth:api', ['except' => ['index', 'show','products']]);
    }

    public function index(Request $request)
    {
        $categories = $this->category->getResults($request->name);
        return response()->json($categories, 200);
    }

    public function show($id)
    {
        $category = $this->category->find($id);

        if (!$category) {
            return response()->json(['error' => 'Categoria não encontrada!'], 404);
        }

        return response()->json($category, 200);
    }

    public function store(StoreUpdateCategoryFormRequest $request)
    {
        $category = $this->category->create($request->all());
        return response()->json($category, 201);
    }

    public function update(StoreUpdateCategoryFormRequest $request, $id)
    {
        $category = $this->category->find($id);

        if (!$category) {
            return response()->json(['error' => 'Categoria não encontrada!'], 404);
        }

        $category->update($request->all());

        return response()->json($category, 200);
    }

    public function destroy($id)
    {
        $category = $this->category->find($id);

        if (!$category) {
            return response()->json(['error' => 'Categoria não encontrada!'], 404);
        }

        $category->delete();
        return response()->json([], 204);
    }

    public function products($id)
    {
        $category = $this->category->find($id);

        if (!$category) {
            return response()->json(['error' => 'Categoria não encontrada!'], 404);
        }

        $products = $category->products()->paginate($this->totalPage);

        return response()->json([
            'category' => $category,
            'products' => $products
        ], 200);
    }
}
