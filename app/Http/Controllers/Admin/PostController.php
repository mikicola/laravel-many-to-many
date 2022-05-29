<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use App\User;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public $validators = [
        'title'     => 'required|max:100',
        'content'   => 'required'
    ];

    private function getValidators($model) {
        return [
            // 'user_id'   => 'required|exists:App\User,id',
            'title'     => 'required|max:100',
            'slug' => [
                'required',
                Rule::unique('posts')->ignore($model),
                'max:100'
            ],
            'category_id' => 'required|exists:categories,id',
            'content'   => 'required'
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
        Post::create($request->all());
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
        return view('admin.posts.edit', compact('post'));
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
        $request->validate($this->getValidators($post));
        $post->update($request->all());

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
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
