<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $title = '';

        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $title = ' in ' . $category->name;
        }

        if (request('author')) {
            $author = User::firstWhere('username', request('author'));
            $title = ' by ' . $author->name;
        }

        return view("posts", [
            "title" => "All Posts" . $title,
            "active" => "posts",
            "posts" => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(7)->withQueryString()
        ]);
    }

    public function show(Post $post)
    {
        return view("post", [
            "title" => "Single Post",
            "active" => "posts",
            "post" => $post
        ]);
    }

    public function showByCategory(Category $category)
    {
        return view("posts", [
            "title" => "Posts By Category: " . $category->name,
            "active" => "posts",
            "category" => $category->name,
            "posts" => $category->posts->load("user", "category")
        ]);
    }

    public function showByAuthor(User $user)
    {
        return view("posts", [
            "title" => "Posts By Author: " . $user->name,
            "active" => "posts",
            "name" => $user->name,
            "posts" => $user->posts->load("user", "category")
        ]);
    }
}
