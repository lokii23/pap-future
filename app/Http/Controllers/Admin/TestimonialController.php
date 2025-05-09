<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'position' => 'required|string',
            'message' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('testimonials', 'public');
        }

        Testimonial::create([
            'name' => $request->name,
            'position' => $request->position,
            'message' => $request->message,
            'image' => $imagePath,
        ]);

        return redirect()->route('testimonials.index')->with('success', 'Testimonial added successfully!');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'name' => 'required|string',
            'position' => 'required|string',
            'message' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $testimonial->image;

        if ($request->hasFile('image')) {
            // Optionally delete old image
            if ($testimonial->image) {
                Storage::disk('public')->delete($testimonial->image);
            }

            $imagePath = $request->file('image')->store('testimonials', 'public');
        }

        $testimonial->update([
            'name' => $request->name,
            'position' => $request->position,
            'message' => $request->message,
            'image' => $imagePath,
        ]);

        return redirect()->route('testimonials.index')->with('success', 'Testimonial updated successfully!');
    }
    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);

        // Delete image from storage if exists
        if ($testimonial->image && \Storage::exists($testimonial->image)) {
            \Storage::delete($testimonial->image);
        }

        $testimonial->delete();

        return redirect()->route('testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }
}
