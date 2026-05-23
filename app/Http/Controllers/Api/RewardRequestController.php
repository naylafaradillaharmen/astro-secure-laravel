<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RewardRequest;
use Illuminate\Http\Request;

class RewardRequestController extends Controller
{
    /**
     * Display all reward requests
     */
    public function index()
    {
        $requests = RewardRequest::with(['child', 'responses'])
            ->latest()
            ->get();

        return response()->json([
            'message' => 'List reward requests',
            'data' => $requests,
        ]);
    }

    /**
     * Store new reward request
     */
    public function store(Request $request)
    {
        $request->validate([
            'child_id' => 'required|exists:users,id',
            'request_text' => 'required|string',
            'status' => 'required|in:pending,approved,rejected',
            'requested_at' => 'required',
        ]);

        $rewardRequest = RewardRequest::create([
            'child_id' => $request->child_id,
            'request_text' => $request->request_text,
            'status' => $request->status,
            'requested_at' => $request->requested_at,
        ]);

        return response()->json([
            'message' => 'Reward request created successfully',
            'data' => $rewardRequest,
        ], 201);
    }

    /**
     * Show detail reward request
     */
    public function show(string $id)
    {
        $rewardRequest = RewardRequest::with(['child', 'responses'])
            ->findOrFail($id);

        return response()->json([
            'message' => 'Detail reward request',
            'data' => $rewardRequest,
        ]);
    }

    /**
     * Update reward request
     */
    public function update(Request $request, string $id)
    {
        $rewardRequest = RewardRequest::findOrFail($id);

        $request->validate([
            'child_id' => 'required|exists:users,id',
            'request_text' => 'required|string',
            'status' => 'required|in:pending,approved,rejected',
            'requested_at' => 'required',
        ]);

        $rewardRequest->update([
            'child_id' => $request->child_id,
            'request_text' => $request->request_text,
            'status' => $request->status,
            'requested_at' => $request->requested_at,
        ]);

        return response()->json([
            'message' => 'Reward request updated successfully',
            'data' => $rewardRequest,
        ]);
    }

    /**
     * Delete reward request
     */
    public function destroy(string $id)
    {
        $rewardRequest = RewardRequest::findOrFail($id);

        $rewardRequest->delete();

        return response()->json([
            'message' => 'Reward request deleted successfully',
        ]);
    }
}