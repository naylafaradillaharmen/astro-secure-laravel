<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DailyReward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DailyRewardController extends Controller
{
    public function index()
    {
        $rewards = DailyReward::latest()->get();

        return response()->json([
            'success' => true,
            'data' => $rewards
        ]);
    }

    public function today()
    {
        $reward = DailyReward::whereDate(
            'reward_date',
            now()->toDateString()
        )->first();

        return response()->json([
            'success' => true,
            'data' => $reward
        ]);
    }

    public function show($id)
    {
        $reward = DailyReward::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $reward
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'reward_date' => 'required|date',
            'reward_text' => 'required|string|max:255',
        ]);

        $reward = DailyReward::create([
            'created_by' => Auth::id(),
            'reward_date' => $validated['reward_date'],
            'reward_text' => $validated['reward_text'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Reward berhasil dibuat',
            'data' => $reward
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $reward = DailyReward::findOrFail($id);

        $validated = $request->validate([
            'reward_date' => 'required|date',
            'reward_text' => 'required|string|max:255',
        ]);

        $reward->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Reward berhasil diperbarui',
            'data' => $reward
        ]);
    }

    public function destroy($id)
    {
        $reward = DailyReward::findOrFail($id);

        $reward->delete();

        return response()->json([
            'success' => true,
            'message' => 'Reward berhasil dihapus'
        ]);
    }
}