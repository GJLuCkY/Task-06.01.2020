<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Resources\TagResource;

class TagController extends Controller
{
    protected $tag;
     /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct(Tag $tag)
    {
        $this->middleware('auth');
        $this->tag = $tag;
    }

    public function index(Request $request)
    {
        try {
            $tagName = $request->get('search');
            return response()->json([
                'data' => (new TagResource($this->tag->whereName($tagName)->firstOrFail()))
            ]);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getCode());
        }
    }
}
