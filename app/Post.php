<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title',
        'slug',
        'content',
        'category_id',
    ];

    public function category()
    {

        return $this->belongsTo('App\Category');
    }

    public static function generateSlug($title)
    {
        $init_slug = Str::slug($title, '-');
        $slug = $init_slug;
        $count = 1;
        $post_found = Post::where('slug', $slug)->first();
        while ($post_found) {
            $slug = $init_slug . '-' . $count;
            $post_found = Post::where('slug', $slug)->first();
            $count++;
        }

        return $slug;
    }
}
