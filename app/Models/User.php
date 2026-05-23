<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Mass Assignable
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'account_type',
        'pin_parent',
        'parent_id',
    ];

    /**
     * Hidden Attributes
     */
    protected $hidden = [
        'password',
        'remember_token',
        'pin_parent',
    ];

    /**
     * Attribute Casting
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Parent dari child
     */
    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    /**
     * Child milik parent
     */
    public function children()
    {
        return $this->hasMany(User::class, 'parent_id');
    }

    /**
     * Schedule yang dibuat parent
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'created_by');
    }

    /**
     * Task submission anak
     */
    public function taskSubmissions()
    {
        return $this->hasMany(TaskSubmission::class, 'child_id');
    }

    /**
     * Screen time rules
     */
    public function screenTimeRules()
    {
        return $this->hasMany(ScreenTimeRule::class, 'child_id');
    }

    /**
     * Screen time logs
     */
    public function screenTimeLogs()
    {
        return $this->hasMany(ScreenTimeLog::class, 'child_id');
    }

    /**
     * Reward requests
     */
    public function rewardRequests()
    {
        return $this->hasMany(RewardRequest::class, 'child_id');
    }

    /**
     * Reward responses
     */
    public function rewardResponses()
    {
        return $this->hasMany(RewardResponse::class, 'parent_id');
    }

    /**
     * Child progress
     */
    public function childProgress()
    {
        return $this->hasOne(ChildProgress::class, 'child_id');
    }
}