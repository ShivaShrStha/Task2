<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;

class MediaController extends Controller
{
    public function index()
    {
        // $medias = Media::latest()->get();
        return view('form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'media_type' => 'required|in:images,videos',
            'images.*' => 'nullable|image|max:1024',
            'videos' => 'nullable|mimes:mp4,avi,webm|max:20480',
        ]);

        $mediaPaths = [];

        if ($request->media_type === 'images' && $request->hasFile('images')) {
            $mediaPaths = array_map(fn($image) => $image->store('images', 'public'), $request->file('images'));
        } elseif ($request->media_type === 'videos' && $request->hasFile('videos')) {
            $mediaPaths[] = $request->file('videos')->store('videos', 'public');
        }

        Media::create([
            'media_type' => $validated['media_type'],
            'media_paths' => json_encode($mediaPaths),
        ]);

        return redirect()->route('form')->with('success', 'Data submitted successfully!');
    }
}
