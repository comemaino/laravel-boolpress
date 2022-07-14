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
        $posts = Post::with(['category', 'tags'])->paginate($request->items_per_page);
        // $post_with_cat = [];
        // foreach ($posts as $post) {
        //     $category = $post->category;
        //     $post['category'] = $category;
        //     $post_with_cat[] = $post;
        // }

        return response()->json([
            'success' => true,
            'results' => $posts
        ]);
    }

    public function show($slug)
    {
        $post = Post::where('slug', '=' . $slug)->with(['category', 'tags'])->first();
        if ($post) {
            return response()->json([
                'success' => true,
                'results' => $post
            ]);
        }
        return response()->json([
            'success' => false,
            'error' => 'no post found'
        ]);
    }
}
