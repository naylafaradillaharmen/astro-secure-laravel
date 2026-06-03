<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChildProgress extends Model
{
    use HasFactory;

    /**
     * Mass Assignable
     */
    protected $fillable = [
        'user_id',
        'level',
        'streak_days',
        'total_completed_tasks',
        'last_activity_date',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Anak pemilik progress
     */
    public function child()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}