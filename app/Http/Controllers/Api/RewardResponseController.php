<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RewardResponse;
use Illuminate\Http\Request;

class RewardResponseController extends Controller
{
    /**
     * Display all reward responses
     */
    public function index()
    {
        $responses = RewardResponse::with(['rewardRequest', 'parent'])
            ->latest()
            ->get();

        return response()->json([
            'message' => 'List reward responses',
            'data' => $responses,
        ]);
    }

    /**
     * Store new reward response
     */
    public function store(Request $request)
    {
        $request->validate([
            'reward_id' => 'required|exists:reward_requests,id',
            'parent_id' => 'required|exists:users,id',
            'response_text' => 'required|string',
            'status' => 'required|in:approved,rejected',
            'responded_at' => 'required',
        ]);

        $response = RewardResponse::create([
            'reward_id' => $request->reward_id,
            'parent_id' => $request->parent_id,
            'response_text' => $request->response_text,
            'status' => $request->status,
            'responded_at' => $request->responded_at,
        ]);

        return response()->json([
            'message' => 'Reward response created successfully',
            'data' => $response,
        ], 201);
    }

    /**
     * Show detail reward response
     */
    public function show(string $id)
    {
        $response = RewardResponse::with(['rewardRequest', 'parent'])
            ->findOrFail($id);

        return response()->json([
            'message' => 'Detail reward response',
            'data' => $response,
        ]);
    }

    /**
     * Update reward response
     */
    public function update(Request $request, string $id)
    {
        $response = RewardResponse::findOrFail($id);

        $request->validate([
            'reward_id' => 'required|exists:reward_requests,id',
            'parent_id' => 'required|exists:users,id',
            'response_text' => 'required|string',
            'status' => 'required|in:approved,rejected',
            'responded_at' => 'required',
        ]);

        $response->update([
            'reward_id' => $request->reward_id,
            'parent_id' => $request->parent_id,
            'response_text' => $request->response_text,
            'status' => $request->status,
            'responded_at' => $request->responded_at,
        ]);

        return response()->json([
            'message' => 'Reward response updated successfully',
            'data' => $response,
        ]);
    }

    /**
     * Delete reward response
     */
    public function destroy(string $id)
    {
        $response = RewardResponse::findOrFail($id);

        $response->delete();

        return response()->json([
            'message' => 'Reward response deleted successfully',
        ]);
    }
}