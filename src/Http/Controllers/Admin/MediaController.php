<?php

namespace Forphp\Blogify\Http\Controllers\Admin;

use Forphp\Blogify\Http\Controllers\Controller;
use Forphp\Blogify\Models\Media;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class MediaController extends Controller
{
    // The MediaList component will handle showing the media.
    // This controller is just for processing data.

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'file' => ['required', 'image', 'max:5120'], // 5MB Max
        ]);

        $file = $request->file('file');

        event(new MediaUploading($file));

        $originalName = $file->getClientOriginalName();
        $filename = time() . '_' . $originalName;
        $directory = 'blogify-media';

        // Store the original file (as WebP)
        $image = Image::read($file->getRealPath());
        $image->toWebp(80)->save(storage_path('app/public/' . $directory . '/' . $filename));

        // Create the media record in the database
        Media::create([
            'disk' => 'public',
            'directory' => $directory,
            'filename' => $filename,
            'original_filename' => $originalName,
            'mime_type' => 'image/webp',
            'size' => $file->getSize(),
        ]);

        event(new MediaUploaded($media));

        return back()->with('success', 'Media uploaded successfully.');
    }

    public function destroy(Media $media): RedirectResponse
    {
        event(new MediaDeleting($media));
        // Delete the file from storage
        Storage::disk($media->disk)->delete($media->directory . '/' . $media->filename);

        // Delete the record from the database
        $media->delete();

        event(new MediaDeleted($media));

        return back()->with('success', 'Media deleted successfully.');
    }
}