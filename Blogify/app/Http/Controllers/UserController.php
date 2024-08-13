<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(User $user) {
        if (!$user){
            return response()->json([
                'error' => 'User does not exist', 404
            ]);
        }
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user, Request $request){
        $current_user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'User does not exist', 404]);
        }

        if ($user->id !== $current_user->id){
            return response()->json(['error' => 'Unauthorized Access'], 403);
        }

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

        return response()->json($user);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user){
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

    public function profile(){
        return $this->show(auth()->user());
    }
}
