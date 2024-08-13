<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function follow(User $user){
        $follower = auth()->user();

        if ($user->id === $follower->id){
            return response()->json(['error' => 'are u fr?']);
        }

        $follower->followings()->attach($user);
        return response()->json(['message' => "You're now following them!"]);
    }

    public function unfollow(User $user){
        $follower = auth()->user();

        if ($user->id === $follower->id){
            return response()->json(['error' => 'are u fr?']);
        }

        $follower->followings()->detach($user);
        return response()->json(['message' => "You're no longer following them"]);
    }
}
