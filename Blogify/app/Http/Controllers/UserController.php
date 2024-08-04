<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $blogs = $user->blogs()->paginate(5);
        return view('users.show', compact('user', 'blogs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $editing = true;
        $blogs = $user->blogs()->paginate(5);
        return view('users.edit', compact('user', 'editing', 'blogs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|min:2|max:50',
            'bio' => 'nullable|min:1|max:255',
            'image' => 'image',
        ]);

        if ($request->has('image')) {
            $imagePath = $request->file('image')->store('profile', 'public');
            $validated['image'] = $imagePath;

            if ($user->image) {
                Storage::disk('public')->delete('{$user->image}');
            }
        }

        $user->update($validated);
        return redirect()->route('profile')->with('successful', 'Profile updated successfully');
    }

    public function profile()
    {
        return $this->show(auth()->user());
    }
}
