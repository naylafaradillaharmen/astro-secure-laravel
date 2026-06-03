<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;

    /**
     * Mass Assignable
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'start_time',
        'repeat_type',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Anak yang menjalankan task
     */
    public function child()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Submission dari schedule ini
     */
    public function taskSubmissions()
    {
        return $this->hasMany(TaskSubmission::class);
    }
}