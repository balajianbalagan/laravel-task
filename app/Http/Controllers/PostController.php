<?php

namespace App\Http\Controllers;

use App\Models\Website;
use App\Models\Post;
use App\Jobs\SendPostEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create(Request $request, Website $website)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        $user = Auth::user() ?? null;

        // Create a new post with or without the user association
        $post = Post::create([
            'user_id' => $user ? $user->id : 1, // Assign user ID if user is authenticated
            'website_id' => $website->id,
            'title' => $data['title'],
            'description' => $data['description'],
        ]);

        // Dispatch the SendPostEmail job to send emails to subscribers
        SendPostEmail::dispatch($post);

        return response()->json($post, 201);
    }

    public function showCreatePostForm(Website $website)
    {
        return view('pages.create-post', compact('website'));
    }

    public function showAllPosts()
{
    $posts = Post::all(); // Assuming you have a Post model
    return view('pages.get-post', compact('posts'));
}


}
