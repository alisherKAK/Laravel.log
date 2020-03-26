<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        return view('posts.index', [
            'title' => 'Стена',
            'posts' => Post::all()
        ]);
    }

    public function create()
    {
        return view('posts.form', [
            'title' => 'Новый пост'
        ]);
    }

    protected function rules() {
        return [
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ];
    }

    public function store(Request $request)
    {
        $request->validate($this->rules());

        $data = $request->except('_token');
        $post = new Post($data);
        $post->user_id = auth()->user()->id;
        $post->save();

        return redirect()->route('posts.show', $post);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'title' => $post->title,
            'post' => $post
        ]);
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('posts.form', [
            'title' => 'Изменить ' . $post->title,
            'post' => $post
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        $request->validate($this->rules());

        $data = $request->except(['_token', '_method']);
        $post->fill($data);
        $post->save();

        return redirect()->route('posts.show', $post);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('posts.index');
    }
}
