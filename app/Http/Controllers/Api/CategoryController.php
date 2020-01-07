<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\User;
use App\Category;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category;
     /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct(Category $category)
    {
        $this->middleware('auth');
        $this->category = $category;
    }

    public function index()
    {
        try {
            return response()->json([
                'data'      => CategoryResource::collection($this->category->get()),
            ]);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getCode());
        }
    }

    public function show($categoryId)
    {
        try {
            return response()->json([
                'data' => (new CategoryResource($this->category->whereId($categoryId)->firstOrFail())),
            ]);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getCode());
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->only(['name']);
            $category = $this->category->create($data);
            return response()->json([
                'data' => (new CategoryResource($category)),
                'message' => 'Категория создана.'
            ]);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getCode());
        }
    }

    public function edit($categoryId, Request $request)
    {
        try {
            $data = $request->only(['name']);
            $category = $this->category->whereId($categoryId)->firstOrFail();
            $category->update($data);
            return response()->json([
                'data' => (new CategoryResource($category)),
                'message' => 'Категория изменена.'
            ]);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getCode());
        }
    }

    public function destroy($categoryId)
    {
        try {
            $category = $this->category->whereId($categoryId)->firstOrFail();
            $category->delete();
            return $this->sendSuccess('Категория удалена.');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getCode());
        }
    }
}
