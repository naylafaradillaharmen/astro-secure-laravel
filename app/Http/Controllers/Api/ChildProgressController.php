<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ChildProgress;
use App\Models\TaskSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChildProgressController extends Controller
{
    /**
     * Display all child progress
     */
    public function index()
    {
        $userId = Auth::id();

        $actualCount = TaskSubmission::where('user_id', $userId)
            ->where('status', 'approved')
            ->count();

        $progress = ChildProgress::with('child')
            ->where('user_id', $userId)
            ->latest()
            ->get();

        if ($progress->isNotEmpty()) {
            $progress->first()->total_completed_tasks = $actualCount;
        }

        return response()->json([
            'message' => 'List child progress',
            'data' => $progress,
        ]);
    }

    /**
     * Store new child progress
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $progress = ChildProgress::create([
            'user_id' => $request->user_id,
            'level' => 1,
            'streak_days' => 0,
            'total_completed_tasks' => 0,
            'last_activity_date' => now(),
        ]);

        return response()->json([
            'message' => 'Child progress created successfully',
            'data' => $progress,
        ], 201);
    }

    /**
     * Show detail child progress
     */
    public function show(string $id)
    {
        $progress = ChildProgress::with('child')
            ->findOrFail($id);

        return response()->json([
            'message' => 'Detail child progress',
            'data' => $progress,
        ]);
    }

    /**
     * Update child progress
     */
    public function update(Request $request, string $id)
    {
        $progress = ChildProgress::findOrFail($id);

        $request->validate([
            'level' => 'required|integer',
            'streak_days' => 'required|integer',
            'total_completed_tasks' => 'required|integer',
            'last_activity_date' => 'nullable|date',
        ]);

        $progress->update([
            'level' => $request->level,
            'streak_days' => $request->streak_days,
            'total_completed_tasks' => $request->total_completed_tasks,
            'last_activity_date' => $request->last_activity_date,
        ]);

        return response()->json([
            'message' => 'Child progress updated successfully',
            'data' => $progress,
        ]);
    }

    /**
     * Delete child progress
     */
    public function destroy(string $id)
    {
        $progress = ChildProgress::findOrFail($id);

        $progress->delete();

        return response()->json([
            'message' => 'Child progress deleted successfully',
        ]);
    }
}