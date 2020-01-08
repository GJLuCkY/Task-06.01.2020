<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\User;
use App\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Filters\ProductFilter;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    protected $product;
     /**
     * Instantiate a new ProductController instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->middleware('auth');
        $this->product = $product;
    }

    public function index(ProductFilter $filters)
    {
        try {
            return response()->json([
                'data' => ProductResource::collection($this->product->query()->filter($filters)->get()),
            ]);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getCode());
        }
    }

    public function addValue($productId, Request $request)
    {
        try {
            $product = $this->product->whereId($productId)->firstOrFail();
            $product->values()->sync($request->get('values'));
            return $this->sendSuccess('Продукт обновлен.');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getCode());
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = \Validator::make($request->all(), [
                'name' => 'required'
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
            $data = $request->only(['name']);
            $product = $this->product->create($data);
            return response()->json([
                'data' => (new ProductResource($product)),
                'message' => 'Продукт создан.'
            ]);
        } catch (ValidationException $e) {
            return $this->sendValidatorError($e->validator->errors());
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getCode());
        }
    }

    public function edit($productId, Request $request)
    {
        try {
            $validator = \Validator::make($request->all(), [
                'name' => 'required'
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
            $data = $request->only(['name']);
            $product = $this->product->whereId($productId)->firstOrFail();
            $product->update($data);
            return response()->json([
                'data' => (new ProductResource($product)),
                'message' => 'Продукт изменен.'
            ]);
        } catch (ValidationException $e) {
            return $this->sendValidatorError($e->validator->errors());
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getCode());
        }
    }

    public function destroy($productId)
    {
        try {
            $product = $this->product->whereId($productId)->firstOrFail();
            $product->delete();
            return $this->sendSuccess('Продукт удален.');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getCode());
        }
    }
}
