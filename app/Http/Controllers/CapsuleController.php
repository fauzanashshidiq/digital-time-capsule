<?php

namespace App\Http\Controllers;

use App\Models\Capsule;
use App\Models\CapsuleImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class CapsuleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Dashboard - list capsule
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $capsules = $user->capsules()
            ->latest()
            ->get();

        return view('dashboard', compact('capsules'));
    }

    /**
     * Form create capsule
     */
    public function create()
    {
        return view('capsules.create');
    }

    /**
     * Simpan capsule
     */
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'unlock_date' => 'required|date|after:today',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $capsule = Capsule::create([
            'user_id' => Auth::id(),
            'message' => $request->message,
            'unlock_date' => $request->unlock_date,
        ]);

        // upload images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Upload ke API Cloudinary
                $response = Http::attach(
                    'file', 
                    file_get_contents($image), 
                    $image->getClientOriginalName()
                )->post("https://api.cloudinary.com/v1_1/" . env('CLOUDINARY_CLOUD_NAME') . "/image/upload", [
                    'upload_preset' => env('CLOUDINARY_UPLOAD_PRESET'),
                    'folder' => 'capsules',
                ]);

                if ($response->successful()) {
                    $url = $response->json()['secure_url'];

                    CapsuleImage::create([
                        'capsule_id' => $capsule->id,
                        'image_path' => $url,
                    ]);
                }
            }
        }

        return redirect()->route('capsules.create')
            ->with('success', 'Capsule berhasil dibuat');
    }

    /**
     * Tampilkan capsule (hanya unlocked)
     */
    public function show(Capsule $capsule)
    {
        $this->authorize('view', $capsule);

        return view('capsules.show', compact('capsule'));
    }

    /**
     * Form edit capsule (locked only)
     */
    public function edit(Capsule $capsule)
    {
        $this->authorize('update', $capsule);

        return view('capsules.edit', compact('capsule'));
    }

    /**
     * Update capsule
     */
    public function update(Request $request, Capsule $capsule)
    {
        $this->authorize('update', $capsule);

        $request->validate([
            'message' => 'required|string',
            'unlock_date' => 'required|date|after:today',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $capsule->update([
            'message' => $request->message,
            'unlock_date' => $request->unlock_date,
        ]);

        foreach ($capsule->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }

        if ($request->hasFile('images')) {

        foreach ($request->file('images') as $image) {
            $path = $image->store('capsules', 'public');

            CapsuleImage::create([
                'capsule_id' => $capsule->id,
                'image_path' => $path,
            ]);
        }
    }

        return redirect()->route('capsules.edit-mode')
            ->with('success', 'Capsule berhasil diupdate');
    }

    /**
     * Hapus capsule
     */
    public function destroy(Capsule $capsule)
    {
        $this->authorize('delete', $capsule);

        // hapus gambar
        foreach ($capsule->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        $capsule->delete();

        return redirect()->route('capsules.delete-mode')
            ->with('success', 'Capsule berhasil dihapus');
    }

    /**
     * Form halaman mode edit
     */
    public function editMode()
    {
        $lockedCapsules = Capsule::where('user_id', Auth::id())
            ->where('is_unlocked', false)
            ->orderBy('unlock_date')
            ->get();

        $unlockedCapsules = Capsule::where('user_id', Auth::id())
            ->where('is_unlocked', true)
            ->orderByDesc('unlock_date')
            ->get();

        return view('capsules.edit-mode', compact(
            'lockedCapsules',
            'unlockedCapsules'
        ));
    }

    /**
     * Form halaman mode delete
     */
    public function deleteMode()
    {
        $lockedCapsules = Capsule::where('user_id', Auth::id())
            ->where('is_unlocked', false)
            ->orderBy('unlock_date')
            ->get();

        $unlockedCapsules = Capsule::where('user_id', Auth::id())
            ->where('is_unlocked', true)
            ->orderByDesc('unlock_date')
            ->get();

        return view('capsules.delete-mode', compact(
            'lockedCapsules',
            'unlockedCapsules'
        ));
    }
}
