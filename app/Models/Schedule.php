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
        'child_id',
        'created_by',
        'title',
        'description',
        'start_time',
        'end_time',
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
        return $this->belongsTo(User::class, 'child_id');
    }

    /**
     * Parent yang membuat task
     */
    public function parent()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Submission dari schedule ini
     */
    public function taskSubmissions()
    {
        return $this->hasMany(TaskSubmission::class);
    }
}