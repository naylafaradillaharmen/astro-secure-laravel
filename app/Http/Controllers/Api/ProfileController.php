<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        return response()->json([
            'message' => 'Profile retrieved successfully',
            'data' => $request->user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'pin_parent' => 'sometimes|string|max:10',
            'child_name' => 'nullable|string|max:255',
            'child_age' => 'nullable|integer|min:1|max:18',
            'parent_name' => 'nullable|string|max:255',
            'parent_age' => 'nullable|integer|min:1|max:120',
            'profile_image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only([
            'name',
            'email',
            'pin_parent',
            'child_name',
            'child_age',
            'parent_name',
            'parent_age',
        ]);

        if ($request->hasFile('profile_image')) {
            if ($user->getRawOriginal('profile_image')) {
                Storage::disk('public')->delete($user->getRawOriginal('profile_image'));
            }

            $data['profile_image'] = $request->file('profile_image')
                ->store('profiles', 'public');
        }

        $user->update($data);

        return response()->json([
            'message' => 'Profile updated successfully',
            'data' => $user->fresh(),
        ]);
    }
}
