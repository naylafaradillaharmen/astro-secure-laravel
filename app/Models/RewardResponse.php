<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RewardResponse extends Model
{
    use HasFactory;

    /**
     * Mass Assignable
     */
    protected $fillable = [
        'reward_id',
        'parent_id',
        'response_text',
        'status',
        'responded_at',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Request reward terkait
     */
    public function rewardRequest()
    {
        return $this->belongsTo(RewardRequest::class, 'reward_id');
    }

    /**
     * Parent yang memberi response
     */
    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }
}