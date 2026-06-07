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
        'pin_parent',
        'active_schedule_type',
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
     * Schedule yang dibuat parent
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'user_id');
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
     * Child progress
     */
    public function progress()
    {
        return $this->hasOne(ChildProgress::class);
    }
}
