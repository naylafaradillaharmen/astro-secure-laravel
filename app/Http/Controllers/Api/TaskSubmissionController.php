<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TaskSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'schedule_id' => 'required|exists:schedules,schedule_id',
            'photo' => 'required|image|max:2048',
            'note' => 'nullable|string',
        ]);

        $photoPath = $request->file('photo')
            ->store('task_submissions', 'public');

        $submission = TaskSubmission::create([
            'schedule_id' => $request->schedule_id,
            'user_id' => Auth::id(),
            'photo_path' => $photoPath,
            'note' => $request->note,
            'status' => 'pending',
            'submitted_at' => now(),
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
            'status' => 'required|in:approved,rejected',
        ]);

        $submission->update([
            'status' => $request->status,
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
