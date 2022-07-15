<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Mail\NewPostNotificationToAdmin;
use App\Post;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $categories = Category::all();
        return view('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //VALIDAZIONE
        $request->validate($this->getValidationRules());
        $data = $request->all();
        //GESTIONESALVATAGGIO IMMAGINE
        if (isset($data['image'])) {
            $image_path = Storage::put('post_covers', $data['image']);
            $data['cover'] = $image_path;
        }
        //CREAZIONE POST
        $post = new Post();
        $post->fill($data);
        $post->slug = Post::generateSlug($post->title);
        $post->save();
        //COLLEGAMENTO TAGS
        if (isset($data['tags'])) {
            $post->tags()->sync($data['tags']);
        }
        //EMAIL NOTIFICA
        Mail::to('admin@boolpress.it')->send(new NewPostNotificationToAdmin($post));
        return redirect()->route('admin.posts.show', ['post' => $post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $now = new Carbon();
        // $now = Carbon::now();
        // dd($now);
        $post = Post::findOrFail($id);
        $updated_mins_ago = $post->updated_at->diffInMinutes($now);
        // dd($updated_mins_ago);

        $category = $post->category;
        // dd($post->tags);
        return view('admin.posts.show', compact('post', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate($this->getValidationRules());

        $data = $request->all();

        $post = Post::findOrFail($id);

        if (isset($data['image'])) {
            if ($post->cover) {
                Storage::delete($post->cover);
            }
            $image_path = Storage::put('post_covers', $data['image']);
            $data['cover'] = $image_path;
        }
        //Metodo fill + save
        // $post->fill($data);
        // $post->slug = Post::generateSlug($post->title);
        // $post->save();

        //Metodo update
        $data['slug'] = Post::generateSlug($data['title']);
        $post->update($data);

        if (isset($data['tags'])) {
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->sync([]);
        }

        return redirect()->route('admin.posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->cover) {
            Storage::delete($post->cover);
        }
        $post->delete();

        return redirect()->route('admin.posts.index');
    }



    private function getValidationRules()
    {
        return [
            'title' => 'required|max:255',
            'content' => 'required|max:30000',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id',
            // 'image' => 'image|max:512'
        ];
    }
}
