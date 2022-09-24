<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('explore');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ids = auth()->user()->following()->get()->pluck('id');
        $posts = Post::whereIn('user_id', $ids)->latest()->get();
        $suggestedUsers = auth()->user()->suggested_users();
        return view('posts.index', compact(['posts', 'suggestedUsers']));
    }

    public function explore()
    {
        $users = User::where('private_account', false)->whereNot('id', auth()->id())->get();
        $posts = collect([]);
        foreach ($users as $user) {
            foreach ($user->posts as $post) {
                $posts->add($post);
            }
        }

        return view('posts.explore', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!empty(request()->session()->get('data'))) {
            request()->session()->forget('data');
        }
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate user input
        $data = request()->validate([
            'description' => ['required'],
            'image' => ['required', 'mimes:jpeg,jpg,png']
        ]);

        // Create a temporary directory
        Storage::makeDirectory('temp');

        // Put the uploaded file in temp folder
        $path = Storage::putFile('temp', request()->file('image'));

        // Add the uploaded file path to $data array
        $data['image'] = basename($path);
        // Add the basename of the uploaded image to $data array
//        $data['basename'] = basename($path);
        // create a unique slug
        $data['slug'] = Str::random(10);
        // add the user id
        $data['user_id'] = auth()->id();


        // Add $data to the current session
        if (empty(request()->session()->get('data'))) {
            request()->session()->put('data', $data);
        }
//        Post::create($data);

        // Redirect to filters page
        return redirect()->route('filters');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $users = $post->likes()->get();
        $more_posts = $post->owner->posts->sortByDesc('created_at')->take(6);
        return view('posts.show', compact(['post', 'users', 'more_posts']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    public function toggle_like(Post $post, User $user)
    {
        return $post->likes()->toggle($user);
    }

    public function filters()
    {
        $data = request()->session()->get('data');
        return view('posts.filters', compact('data'));
    }

    public function store_filtered()
    {
        $data = request()->session()->get('data');
        Storage::move('temp/' . $data['image'], 'posts/' . $data['image']);
        Storage::deleteDirectory('temp');
        Post::create($data);
        request()->session()->forget('data');
        return redirect()->route('home_page');
    }

}
