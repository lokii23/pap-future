<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facebook;

class FacebookPostController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'posted_at' => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('facebook-posts', 'public');
        }

        FacebookPost::create($data);

        return redirect()->route('facebook-posts.index')->with('success', 'Post added successfully!');
    }

    public function destroy(FacebookPost $facebookPost)
    {
        if ($facebookPost->image) {
            Storage::disk('public')->delete($facebookPost->image);
        }

        $facebookPost->delete();

        return redirect()->route('facebook-posts.index')->with('success', 'Post deleted.');
    }

    public function index()
    {
        $posts = Facebook::latest()->get(); // You can change sorting if needed
        return view('admin.facebook-posts.index', compact('posts'));
    }


}
