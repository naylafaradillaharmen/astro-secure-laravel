<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScreenTimeLog extends Model
{
    use HasFactory;

    /**
     * Mass Assignable
     */
    protected $fillable = [
        'child_id',
        'start_time',
        'end_time',
        'duration_minutes',
        'notified_parent',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Anak pemilik log screen time
     */
    public function child()
    {
        return $this->belongsTo(User::class, 'child_id');
    }
}