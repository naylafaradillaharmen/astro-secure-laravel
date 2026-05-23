<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScreenTimeRule extends Model
{
    use HasFactory;

    /**
     * Mass Assignable
     */
    protected $fillable = [
        'child_id',
        'created_by',
        'start_time',
        'end_time',
        'limit_minutes',
        'warning_minutes',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Anak yang memiliki aturan
     */
    public function child()
    {
        return $this->belongsTo(User::class, 'child_id');
    }

    /**
     * Parent yang membuat aturan
     */
    public function parent()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}