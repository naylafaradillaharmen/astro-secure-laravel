<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TaskSubmission;
use Illuminate\Http\Request;

class TaskSubmissionController extends Controller
{
    /**
     * Display all submissions
     */
    public function index()
    {
        $submissions = TaskSubmission::with(['schedule', 'child'])
            ->latest()
            ->get();

        return response()->json([
            'message' => 'List task submissions',
            'data' => $submissions,
        ]);
    }

    /**
     * Store new submission
     */
    public function store(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'user_id' => 'required|exists:users,id',
            'photo_path' => 'required|string',
            'note' => 'nullable|string',
            'status' => 'required|in:pending,approved,rejected',
            'submitted_at' => 'required',
        ]);

        $submission = TaskSubmission::create([
            'schedule_id' => $request->schedule_id,
            'user_id' => $request->user_id,
            'photo_path' => $request->photo_path,
            'note' => $request->note,
            'status' => $request->status,
            'submitted_at' => $request->submitted_at,
        ]);

        return response()->json([
            'message' => 'Task submission created successfully',
            'data' => $submission,
        ], 201);
    }

    /**
     * Show detail submission
     */
    public function show(string $id)
    {
        $submission = TaskSubmission::with(['schedule', 'child'])
            ->findOrFail($id);

        return response()->json([
            'message' => 'Detail task submission',
            'data' => $submission,
        ]);
    }

    /**
     * Update submission
     */
    public function update(Request $request, string $id)
    {
        $submission = TaskSubmission::findOrFail($id);

        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'user_id' => 'required|exists:users,id',
            'photo_path' => 'required|string',
            'note' => 'nullable|string',
            'status' => 'required|in:pending,approved,rejected',
            'submitted_at' => 'required',
        ]);

        $submission->update([
            'schedule_id' => $request->schedule_id,
            'user_id' => $request->user_id,
            'photo_path' => $request->photo_path,
            'note' => $request->note,
            'status' => $request->status,
            'submitted_at' => $request->submitted_at,
        ]);

        return response()->json([
            'message' => 'Task submission updated successfully',
            'data' => $submission,
        ]);
    }

    /**
     * Delete submission
     */
    public function destroy(string $id)
    {
        $submission = TaskSubmission::findOrFail($id);

        $submission->delete();

        return response()->json([
            'message' => 'Task submission deleted successfully',
        ]);
    }
}