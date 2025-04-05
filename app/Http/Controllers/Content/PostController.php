<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    public function index(Request $request): Response
    {
        $posts = Post::all();

        return Inertia::render('post.index', [
            'posts' => $posts,
        ]);
    }

    public function show($id): Response
    {
        $post = Post::findOrFail($id);
        return Inertia::render('content/Post', [
            'post' => $post,
        ]);
    }

    public function store(PostStoreRequest $request): RedirectResponse
    {
        $post = Post::create($request->validated());

        $request->session()->flash('post.title', $post->title);

        return redirect()->route('post.index');
    }
}
