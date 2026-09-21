<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyMediaController extends Controller
{
    /**
     * Upload property photo/video.
     */
    public function store(Request $request, Property $property)
    {
        // Make sure this property belongs to logged-in dealer
        abort_unless(
            $property->user_id === auth()->id(),
            403
        );

        $validated = $request->validate([
            'media' => 'required|file|mimes:jpg,jpeg,png,webp,mp4,mov,webm|max:51200',
        ]);

        $file = $request->file('media');

        $type = str_starts_with($file->getMimeType(), 'image/')
            ? 'image'
            : 'video';

        $path = $file->store(
            'properties/' . $property->id,
            'public'
        );

        // First uploaded image automatically becomes cover
        $isCover = $type === 'image'
            && ! $property->media()
                ->where('type', 'image')
                ->exists();

        $property->media()->create([
            'type' => $type,
            'file_path' => $path,
            'is_cover' => $isCover,
        ]);

        return back()->with('success', 'Media uploaded successfully.');
    }

    /**
     * Set an image as property cover.
     */
    public function setCover(PropertyMedia $media)
    {
        // Make sure media belongs to logged-in dealer
        abort_unless(
            $media->property->user_id === auth()->id(),
            403
        );

        // Only images can be cover
        if ($media->type !== 'image') {
            return back()->with('error', 'Only images can be used as a cover.');
        }

        // Remove cover from all images of this property
        $media->property
            ->media()
            ->where('type', 'image')
            ->update([
                'is_cover' => false,
            ]);

        // Set selected image as cover
        $media->update([
            'is_cover' => true,
        ]);

        return back()->with('success', 'Cover photo updated successfully.');
    }

    /**
     * Delete property media.
     */
    public function destroy(PropertyMedia $media)
    {
        // Make sure media belongs to logged-in dealer
        abort_unless(
            $media->property->user_id === auth()->id(),
            403
        );

        Storage::disk('public')->delete($media->file_path);

        $media->delete();

        return back()->with('success', 'Media deleted successfully.');
    }
}