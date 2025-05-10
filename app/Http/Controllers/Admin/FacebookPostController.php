<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facebook;
use Illuminate\Support\Facades\Storage;

class FacebookPostController extends Controller
{
    
    public function index()
    {
        $facebooks = Facebook::latest()->get(); // fetch posts
        return view('admin.facebook-posts.index', compact('facebooks')); // pass to view
    }

    public function create()
    {
        return view('admin.facebook-posts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'posted_at' => 'nullable|date',
            'link' => 'required|url|max:255', // <-- validate the link
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('facebook', 'public');
        }

        Facebook::create([
            'title' => $request->title,
            'author' => $request->author,
            'category' => $request->category,
            'image' => $imagePath,
            'description' => $request->description,
            'posted_at' => $request->posted_at,
            'link' => $request->link,
        ]);

        return redirect()->route('facebook-posts.index')->with('success', 'Facebook Posts added successfully!');
    }
    
    public function destroy($id)
    {
        $facebook = Facebook::findOrFail($id);

        // Delete image from storage if exists
        if ($facebook->image && \Storage::exists($facebook->image)) {
            \Storage::delete($facebook->image);
        }

        $facebook->delete();

        return redirect()->route('facebook-posts.index')->with('success', 'Facebook deleted successfully.');
    }


}
