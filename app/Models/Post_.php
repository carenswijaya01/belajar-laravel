<?php

namespace App\Models;

/** ================== POST v1 ================== */

class Post_
{
    private static $blog_posts = [
        [
            "title" => "Judul Post Pertama",
            "slug" => "judul-post-pertama",
            "author" => "Carens",
            "body" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur ea ab aliquid accusantium, quasi placeat ipsum ipsa ut laudantium eius non sapiente adipisci necessitatibus quaerat exercitationem. Natus optio voluptate debitis."
        ],
        [
            "title" => "Judul Post Kedua",
            "slug" => "judul-post-kedua",
            "author" => "Wijaya",
            "body" => "Lorem ipsum dolor sit amet consectetur adipisicing elit."
        ],
    ];

    public static function all()
    {
        //Bikin dari bentuk array ke collection
        return collect(self::$blog_posts);
    }

    public static function find($slug)
    {
        // $foundPost = array();
        // foreach (self::$blog_posts as $post) {
        //     if ($post['slug'] == $slug) {
        //         $foundPost = $post;
        //     }
        // }
        // return $foundPost;

        $posts = static::all();
        return $posts->firstWhere('slug', $slug);
    }
}
