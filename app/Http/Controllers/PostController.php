<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;


class PostController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $user = $this->userRepository->getUserWithProfile(Auth::id());
        $posts = Post::with('user')
                        ->orderBy('created_at', 'desc')
                        ->paginate(50);
        
        if (!$user) {
            return redirect()->route('login');
        }
        return view('posts.index', compact('user', 'posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'texts' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $post = new Post($validated);
        $post->user_id = auth()->id();  // Associate the post with the authenticated user
        $post->save();
    
        return redirect()->route('dashboard.view');
        
        // Post::create($validated);

        // return redirect()->route('posts.index');
    }

    public function show(string $id)
    {
        $user = $this->userRepository->getUserWithProfile(Auth::id());
        $post = Post::with('user')
                        ->where('id', $id)
                        ->first();
        if (!$user) {
            return redirect()->route('login');
        }
        // dd($post);
        return view('posts.post', compact('user', 'post'));
        // return view('post.show', compact('post'));
    }

    public function edit(string $id)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
        ]);

        $post = Post::find($id);
        $post->update($validated);

        return redirect()->route('posts.index');
    }

    public function destroy(string $id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('posts.index');
    }


    private function getView($viewName, $data)
    {
        $user = $this->getUserWithProfile();
        // dd($user);
        if (!$user) {
            return redirect()->route('login');
        }
        return view($viewName, compact('user'));
    }

    private function getUserWithProfile()
    {
        return $this->userRepository->getUserWithProfile(Auth::id());
    }
}
