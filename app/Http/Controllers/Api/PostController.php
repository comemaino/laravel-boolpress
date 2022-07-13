<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $items_per_page = $request->itmes_per_page ? $request->itmes_per_page : 6;
        $posts = Post::paginate($request->items_per_page);
        return response()->json([
            'success' => true,
            'results' => $posts
        ]);
    }
}
