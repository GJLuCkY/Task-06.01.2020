<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\User;

class CategoryController extends Controller
{
     /**
     * Instantiate a new UserController instance.
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

    public function products($categoryId)
    {
        //
        return 1;
    }

    public function create()
    {
        return 1;
    }

    public function edit($categoryId)
    {
        return 1;
    }

    public function delete($categoryId)
    {
        return 1;
    }
}
