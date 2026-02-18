<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Notifications\NewAnnouncement;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $announcements = Announcement::with('user')->latest()->get();
        return view('announcements.index', compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->isAdmin() && !auth()->user()->isDirector()) {
            abort(403);
        }
        return view('announcements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->isAdmin() && !auth()->user()->isDirector()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|in:info,success,warning,error',
            'image' => 'nullable|image|max:2048',
        ]);

        $validated['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file->isValid()) {
                $tempPath = $file->getPathname();
                if ($tempPath && file_exists($tempPath)) {
                    $name = $file->hashName();
                    $stream = fopen($tempPath, 'r');
                    if ($stream) {
                        Storage::disk('public')->put('announcements/' . $name, $stream);
                        fclose($stream);
                        $validated['image_path'] = 'announcements/' . $name;
                    }
                }
            }
        }

        // Remove the file object from validation data before database insertion
        unset($validated['image']);

        $announcement = Announcement::create($validated);

        // Notify users: Admins and Directors only receive their own notifications, others receive all
        $users = User::all()->filter(function ($user) use ($announcement) {
            if ($user->isAdmin() || $user->isDirector()) {
                return $user->id === $announcement->user_id;
            }
            return true;
        });

        foreach ($users as $user) {
            $user->notify(new NewAnnouncement($announcement));
        }

        return redirect()->route('announcements.index')->with('success', 'Announcement created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Announcement $announcement)
    {
        return view('announcements.show', compact('announcement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Announcement $announcement)
    {
        if (!auth()->user()->isAdmin() && !auth()->user()->isDirector()) {
            abort(403);
        }
        return view('announcements.edit', compact('announcement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Announcement $announcement)
    {
        if (!auth()->user()->isAdmin() && !auth()->user()->isDirector()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|in:info,success,warning,error',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($announcement->image_path) {
                Storage::disk('public')->delete($announcement->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('announcements', 'public');
        }

        $announcement->update($validated);

        return redirect()->route('announcements.index')->with('success', 'Announcement updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement)
    {
        if (!auth()->user()->isAdmin() && !auth()->user()->isDirector()) {
            abort(403);
        }

        if ($announcement->image_path) {
            Storage::disk('public')->delete($announcement->image_path);
        }
        $announcement->delete();

        return redirect()->route('announcements.index')->with('success', 'Announcement deleted successfully.');
    }
}
