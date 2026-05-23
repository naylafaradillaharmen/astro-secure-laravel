<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ScreenTimeLog;
use Illuminate\Http\Request;

class ScreenTimeLogController extends Controller
{
    /**
     * Display all logs
     */
    public function index()
    {
        $logs = ScreenTimeLog::with('child')
            ->latest()
            ->get();

        return response()->json([
            'message' => 'List screen time logs',
            'data' => $logs,
        ]);
    }

    /**
     * Store new log
     */
    public function store(Request $request)
    {
        $request->validate([
            'child_id' => 'required|exists:users,id',
            'start_time' => 'required',
            'end_time' => 'nullable',
            'duration_minutes' => 'required|integer',
            'notified_parent' => 'required|boolean',
        ]);

        $log = ScreenTimeLog::create([
            'child_id' => $request->child_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'duration_minutes' => $request->duration_minutes,
            'notified_parent' => $request->notified_parent,
        ]);

        return response()->json([
            'message' => 'Screen time log created successfully',
            'data' => $log,
        ], 201);
    }

    /**
     * Show detail log
     */
    public function show(string $id)
    {
        $log = ScreenTimeLog::with('child')
            ->findOrFail($id);

        return response()->json([
            'message' => 'Detail screen time log',
            'data' => $log,
        ]);
    }

    /**
     * Update log
     */
    public function update(Request $request, string $id)
    {
        $log = ScreenTimeLog::findOrFail($id);

        $request->validate([
            'child_id' => 'required|exists:users,id',
            'start_time' => 'required',
            'end_time' => 'nullable',
            'duration_minutes' => 'required|integer',
            'notified_parent' => 'required|boolean',
        ]);

        $log->update([
            'child_id' => $request->child_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'duration_minutes' => $request->duration_minutes,
            'notified_parent' => $request->notified_parent,
        ]);

        return response()->json([
            'message' => 'Screen time log updated successfully',
            'data' => $log,
        ]);
    }

    /**
     * Delete log
     */
    public function destroy(string $id)
    {
        $log = ScreenTimeLog::findOrFail($id);

        $log->delete();

        return response()->json([
            'message' => 'Screen time log deleted successfully',
        ]);
    }
}