<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RewardRequest extends Model
{
    use HasFactory;

    /**
     * Mass Assignable
     */
    protected $fillable = [
        'child_id',
        'request_text',
        'status',
        'requested_at',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Anak yang request reward
     */
    public function child()
    {
        return $this->belongsTo(User::class, 'child_id');
    }

    /**
     * Response dari parent
     */
    public function responses()
    {
        return $this->hasMany(RewardResponse::class, 'reward_id');
    }
}