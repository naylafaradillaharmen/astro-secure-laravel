<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyReward extends Model
{
    protected $primaryKey = 'reward_id';

    protected $fillable = [
        'created_by',
        'reward_date',
        'reward_text',
    ];

    protected $casts = [
        'reward_date' => 'date',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'user_id');
    }
}