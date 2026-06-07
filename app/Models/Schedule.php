<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $primaryKey = 'schedule_id';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'type',
        'activity_order',
        'title',
        'description',
        'start_time',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'activity_order' => 'integer',
        'start_time' => 'datetime:H:i:s',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function todaySubmission()
    {
        return $this->hasOne(TaskSubmission::class, 'schedule_id')
            ->whereDate('submitted_at', today());
    }
}