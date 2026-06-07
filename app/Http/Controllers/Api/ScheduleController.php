<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $type = $request->query('type'); // 'santai', 'produktif', 'aktif'

        if ($type) {
            $count = match ($type) {
                'santai' => 3,
                'produktif' => 5,
                'aktif' => 7,
                default => 0
            };

            if ($count > 0) {
                $schedules = Schedule::where('user_id', $userId)
                    ->where('type', $type)
                    ->orderBy('activity_order', 'asc')
                    ->get();

                if ($schedules->count() < $count) {
                    $missing = $count - $schedules->count();
                    for ($i = 0; $i < $missing; $i++) {
                        Schedule::create([
                            'user_id' => $userId,
                            'type' => $type,
                            'activity_order' => $schedules->count() + $i + 1,
                            'title' => 'Isi Jadwal Kegiatan',
                            'description' => '',
                            'start_time' => '08:00',
                            'is_active' => false,
                        ]);
                    }
                    $schedules = Schedule::where('user_id', $userId)
                        ->where('type', $type)
                        ->orderBy('activity_order', 'asc')
                        ->get();
                }

                return response()->json([
                    'message' => 'Schedules retrieved successfully',
                    'data' => $schedules,
                ]);
            }
        }

        $schedules = Schedule::where('user_id', $userId)
            ->orderBy('activity_order', 'asc')
            ->get();

        return response()->json([
            'message' => 'Schedules retrieved successfully',
            'data' => $schedules,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:santai,produktif,aktif',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date_format:H:i',
        ]);

        // Find next activity order for this type
        $maxOrder = Schedule::where('user_id', $request->user()->id)
            ->where('type', $validated['type'])
            ->max('activity_order') ?? 0;

        $schedule = Schedule::create([
            'user_id' => $request->user()->id,
            'type' => $validated['type'],
            'activity_order' => $maxOrder + 1,
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'start_time' => $validated['start_time'],
            'is_active' => true,
        ]);

        return response()->json([
            'message' => 'Schedule created successfully',
            'data' => $schedule,
        ], 201);
    }

    public function show(Request $request, $id)
    {
        $schedule = Schedule::where('user_id', $request->user()->id)
            ->findOrFail($id);

        return response()->json($schedule);
    }

    public function update(Request $request, $id)
    {
        $schedule = Schedule::where('user_id', $request->user()->id)
            ->findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'sometimes|date_format:H:i',
            'is_active' => 'sometimes|boolean',
        ]);

        $schedule->update($validated);

        return response()->json([
            'message' => 'Schedule updated successfully',
            'data' => $schedule,
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $schedule = Schedule::where('user_id', $request->user()->id)
            ->findOrFail($id);

        $schedule->delete();

        return response()->json([
            'message' => 'Schedule deleted successfully',
        ]);
    }

    // GET /api/schedules/active
    public function getActive(Request $request)
    {
        $user = $request->user();
        $activeType = $user->active_schedule_type ?? 'santai';

        $schedules = Schedule::where('user_id', $user->id)
            ->where('type', $activeType)
            ->orderBy('activity_order', 'asc')
            ->get();

        $count = match ($activeType) {
            'santai' => 3,
            'produktif' => 5,
            'aktif' => 7,
            default => 3
        };

        if ($schedules->count() < $count) {
            $missing = $count - $schedules->count();
            for ($i = 0; $i < $missing; $i++) {
                Schedule::create([
                    'user_id' => $user->id,
                    'type' => $activeType,
                    'activity_order' => $schedules->count() + $i + 1,
                    'title' => 'Isi Jadwal Kegiatan',
                    'description' => '',
                    'start_time' => '08:00',
                    'is_active' => false,
                ]);
            }
            $schedules = Schedule::where('user_id', $user->id)
                ->where('type', $activeType)
                ->orderBy('activity_order', 'asc')
                ->get();
        }

        // Map is_completed based on today's submission status for the child
        $data = $schedules->map(function ($schedule) use ($user) {
            // Check submission for today
            $isCompleted = \App\Models\TaskSubmission::where('schedule_id', $schedule->schedule_id)
                ->where('user_id', $user->id)
                ->whereDate('submitted_at', \Carbon\Carbon::today())
                ->exists();

            $schedule->is_completed = $isCompleted;
            return $schedule;
        });

        return response()->json([
            'message' => 'Active schedules retrieved successfully',
            'active_type' => $activeType,
            'data' => $data,
        ]);
    }

    // POST /api/schedules/active
    public function setActive(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:santai,produktif,aktif',
        ]);

        $user = $request->user();
        $user->active_schedule_type = $validated['type'];
        $user->save();

        return response()->json([
            'message' => 'Active schedule type updated successfully',
            'active_type' => $user->active_schedule_type,
        ]);
    }
}