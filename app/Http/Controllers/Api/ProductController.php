<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\User;

class ProductController extends Controller
{
     /**
     * Instantiate a new ProductController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return 1;
    }

    public function addValue($productId)
    {
        //
        return 1;
    }

    public function create()
    {
        return 1;
    }

    public function edit($productId)
    {
        return 1;
    }

    public function delete($productId)
    {
        return 1;
    }
}
