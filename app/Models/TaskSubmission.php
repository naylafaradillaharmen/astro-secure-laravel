<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TaskSubmission extends Model
{
    use HasFactory;

    /**
     * Mass Assignable
     */
    protected $fillable = [
        'schedule_id',
        'user_id',
        'photo_path',
        'note',
        'status',
        'submitted_at',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Schedule dari submission ini
     */
    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id', 'schedule_id');
    }

    /**
     * Anak yang submit task
     */
    public function child()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}