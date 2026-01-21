<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }
        $users = User::with('todayAvailability')->paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }
        $validated = $request->validated();

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = \Illuminate\Support\Facades\Hash::make($validated['password']);
        $user->role = $validated['role'];
        $user->save();

        if ($request->hasFile('profile_photo') && $request->file('profile_photo')->isValid()) {
            $user->addMediaFromRequest('profile_photo')
                ->toMediaCollection('avatars');
        }

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if (!auth()->user()->isAdmin() && auth()->id() !== $user->id) {
            abort(403, 'Unauthorized access.');
        }
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if (!auth()->user()->isAdmin() && auth()->id() !== $user->id) {
            abort(403, 'Unauthorized access.');
        }
        \Illuminate\Support\Facades\Log::info('User Update Start', [
            'target_user' => $user->id,
            'auth_user' => auth()->id(),
            'has_file' => $request->hasFile('profile_photo'),
        ]);

        $validated = $request->validated();

        if ($request->hasFile('profile_photo') && $request->file('profile_photo')->isValid()) {
            $user->addMediaFromRequest('profile_photo')
                ->toMediaCollection('avatars');
        }

        if ($request->filled('password')) {
            $user->password = \Illuminate\Support\Facades\Hash::make($validated['password']);
        }

        $user->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        // Only update role if provided (admin-only)
        if (isset($validated['role'])) {
            $user->role = $validated['role'];
        }

        $user->save();

        return redirect()->route('users.show', $user)->with('success', 'Profile updated successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }
        if (auth()->id() === $user->id) {
            return redirect()->route('users.index')->with('error', 'You cannot delete your own account.');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
