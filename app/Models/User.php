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
        'child_name',
        'child_age',
        'parent_name',
        'parent_age',
        'profile_image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
        'profile_image_url',
    ];

    public function getProfileImageAttribute($value): ?string
    {
        if (!$value) {
            return null;
        }

        return request()->getSchemeAndHttpHost() . '/storage/' . $value;
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'child_age' => 'integer',
            'parent_age' => 'integer',
        ];
    }

    public function getProfileImageUrlAttribute(): ?string
    {
        $original = $this->getRawOriginal('profile_image');

        if (!$original) {
            return null;
        }

        return request()->getSchemeAndHttpHost() . '/storage/' . $original;
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
        return $this->hasMany(TaskSubmission::class, 'user_id');
    }

    /**
     * Screen time rules
     */
    public function screenTimeRules()
    {
        return $this->hasMany(ScreenTimeRule::class, 'user_id');
    }

    /**
     * Screen time logs
     */
    public function screenTimeLogs()
    {
        return $this->hasMany(ScreenTimeLog::class, 'user_id');
    }

    /**
     * Child progress
     */
    public function progress()
    {
        return $this->hasOne(ChildProgress::class);
    }
}
