<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    // public $validators = [
    //     'title'     => 'required|max:100',
    //     'content'   => 'required'
    // ];

    private function getValidators($model) {
        return [
            // 'user_id'   => 'required|exists:App\User,id',
            'title'     => 'required|max:100',
            'slug' => [
                'required',
                Rule::unique('posts')->ignore($model),
                'max:100'
            ],
            'category_id' => 'required|',
            'content'   => 'required',
            'tags'      => 'exists:App\Tag,id'
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myindex(){
        $posts = Post::with('category')->orderBy('id', 'desc')->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }
    public function index(Request $request)
    {
        //filtri ricerca
        // /*
        $posts = Post::where('title', 'like', '%' . $request['title'] . '%')
        ->where('content', 'like', '%' . $request['title'] . '%')
        ->where('category_id', '=', $request['category'])
        ->where('user_id', '=', $request['author'])
        ->paginate(20);
        // */

        /*
        $posts = Post::where('id', '>', 0);
        if ($request->s) {
            $posts = $posts->where('title', 'like', '%' . $request->s . '%');
        }


        if ($request->category) {
            $posts = $posts->where('category_id', $request->category);
        }

        if ($request->author) {
            $posts = $posts->where('user_id', $request->author);
        }
        */

        $posts = Post::paginate(20);

        $categories = Category::all();

        $users = User::all();

        return view('admin.posts.index', [
            'posts' => $posts,
            'categories' => $categories,
            'users' => $users,
            'request' => $request
        ]);
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
        return view('admin.posts.create', [
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->getValidators(null));

        $formData = $request->all() + ['user_id' => Auth::user()->id];

        $post = Post::create($formData);
        $post->tags()->attach($formData['tags']);

        return redirect()->route('admin.posts.show', $posts->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // if (Auth::user()->id !== $post->user_id) abort(403);
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', [
            'post'          => $post,
            'categories'    => $categories,
            'tags'          => $tags
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // if (Auth::user()->id !== $post->user_id) abort(403);

        $request->validate($this->getValidators($post));
        $formData = $request->all();
        $post->update($formData);
        $post->tags()->sync($formData['tags']);

        return redirect()->route('admin.posts.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // if (Auth::user()->id !== $post->user_id) abort(403);
        $post->tags()->detach();
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
