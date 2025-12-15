<?php

namespace App\Http\Controllers;

use App\Models\Capsule;
use App\Models\CapsuleImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

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

        return view('capsules.index', compact('capsules'));
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
            'images.*' => 'nullable|image|max:2048',
        ]);

        $capsule = Capsule::create([
            'user_id' => Auth::id(),
            'message' => $request->message,
            'unlock_date' => $request->unlock_date,
        ]);

        // upload images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('capsules', 'public');

                CapsuleImage::create([
                    'capsule_id' => $capsule->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('capsules.index')
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
        ]);

        $capsule->update([
            'message' => $request->message,
            'unlock_date' => $request->unlock_date,
        ]);

        return redirect()->route('capsules.index')
            ->with('success', 'Capsule berhasil diupdate');
    }

    /**
     * Hapus capsule (locked only)
     */
    public function destroy(Capsule $capsule)
    {
        $this->authorize('delete', $capsule);

        // hapus gambar
        foreach ($capsule->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        $capsule->delete();

        return redirect()->route('capsules.index')
            ->with('success', 'Capsule berhasil dihapus');
    }

    /**
     * Unlock capsule (manual check)
     */
    public function unlock(Capsule $capsule)
    {
        if (! $capsule->canBeUnlocked()) {
            abort(403, 'Capsule belum waktunya dibuka');
        }

        if (! $capsule->is_unlocked) {
            $capsule->update([
                'is_unlocked' => true,
                'unlocked_at' => now(),
            ]);
        }

        return redirect()->route('capsules.show', $capsule);
    }
}
