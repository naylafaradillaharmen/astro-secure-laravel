<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display all schedules
     */
    public function index()
    {
        $schedules = Schedule::with(['child', 'parent'])->latest()->get();

        return response()->json([
            'message' => 'List schedules',
            'data' => $schedules,
        ]);
    }

    /**
     * Store new schedule
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required',
            'repeat_type' => 'required|in:daily,weekly',
        ]);

        $schedule = Schedule::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description,
            'start_time' => $request->start_time,
            'repeat_type' => $request->repeat_type,
        ]);

        return response()->json([
            'message' => 'Schedule created successfully',
            'data' => $schedule,
        ], 201);
    }

    /**
     * Show detail schedule
     */
    public function show(string $id)
    {
        $schedule = Schedule::with(['child', 'parent'])
            ->findOrFail($id);

        return response()->json([
            'message' => 'Detail schedule',
            'data' => $schedule,
        ]);
    }

    /**
     * Update schedule
     */
    public function update(Request $request, string $id)
    {
        $schedule = Schedule::findOrFail($id);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required',
            'repeat_type' => 'required|in:daily,weekly',
        ]);

        $schedule->update([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description,
            'start_time' => $request->start_time,
            'repeat_type' => $request->repeat_type,
        ]);

        return response()->json([
            'message' => 'Schedule updated successfully',
            'data' => $schedule,
        ]);
    }

    /**
     * Delete schedule
     */
    public function destroy(string $id)
    {
        $schedule = Schedule::findOrFail($id);

        $schedule->delete();

        return response()->json([
            'message' => 'Schedule deleted successfully',
        ]);
    }
}