<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ScreenTimeRule;
use Illuminate\Http\Request;

class ScreenTimeRuleController extends Controller
{
    /**
     * Display all rules
     */
    public function index()
    {
        $rules = ScreenTimeRule::with(['child', 'parent'])
            ->latest()
            ->get();

        return response()->json([
            'message' => 'List screen time rules',
            'data' => $rules,
        ]);
    }

    /**
     * Store new rule
     */
    public function store(Request $request)
    {
        $request->validate([
            'child_id' => 'required|exists:users,id',
            'created_by' => 'required|exists:users,id',
            'start_time' => 'required',
            'end_time' => 'required',
            'limit_minutes' => 'required|integer',
            'warning_minutes' => 'required|integer',
        ]);

        $rule = ScreenTimeRule::create([
            'child_id' => $request->child_id,
            'created_by' => $request->created_by,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'limit_minutes' => $request->limit_minutes,
            'warning_minutes' => $request->warning_minutes,
        ]);

        return response()->json([
            'message' => 'Screen time rule created successfully',
            'data' => $rule,
        ], 201);
    }

    /**
     * Show detail rule
     */
    public function show(string $id)
    {
        $rule = ScreenTimeRule::with(['child', 'parent'])
            ->findOrFail($id);

        return response()->json([
            'message' => 'Detail screen time rule',
            'data' => $rule,
        ]);
    }

    /**
     * Update rule
     */
    public function update(Request $request, string $id)
    {
        $rule = ScreenTimeRule::findOrFail($id);

        $request->validate([
            'child_id' => 'required|exists:users,id',
            'created_by' => 'required|exists:users,id',
            'start_time' => 'required',
            'end_time' => 'required',
            'limit_minutes' => 'required|integer',
            'warning_minutes' => 'required|integer',
        ]);

        $rule->update([
            'child_id' => $request->child_id,
            'created_by' => $request->created_by,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'limit_minutes' => $request->limit_minutes,
            'warning_minutes' => $request->warning_minutes,
        ]);

        return response()->json([
            'message' => 'Screen time rule updated successfully',
            'data' => $rule,
        ]);
    }

    /**
     * Delete rule
     */
    public function destroy(string $id)
    {
        $rule = ScreenTimeRule::findOrFail($id);

        $rule->delete();

        return response()->json([
            'message' => 'Screen time rule deleted successfully',
        ]);
    }
}