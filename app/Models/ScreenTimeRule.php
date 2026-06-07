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
        'user_id',
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
        return $this->belongsTo(User::class, 'user_id');
    }
}
