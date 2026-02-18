<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\HasDatabaseNotifications;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable implements HasMedia
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasDatabaseNotifications, InteractsWithMedia, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_photo_path',
    ];

    /**
     * The attributes that should be appended to the user array.
     *
     * @var list<string>
     */
    protected $appends = [
        'profile_photo_url',
        'current_status',
        'role_label',
    ];

    public function getRoleLabelAttribute(): string
    {
        return match ($this->role) {
            self::ROLE_ADMIN => 'Admin',
            self::ROLE_DIRECTOR => 'Director',
            self::ROLE_TEAM_LEADER => 'Team Leader',
            default => 'User',
        };
    }

    const ROLE_ADMIN = 'admin';
    const ROLE_DIRECTOR = 'director';
    const ROLE_TEAM_LEADER = 'team_leader';
    const ROLE_USER = 'user';

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isTeamLeader(): bool
    {
        return $this->role === self::ROLE_TEAM_LEADER;
    }

    public function isDirector(): bool
    {
        return $this->role === self::ROLE_DIRECTOR;
    }

    public function isUser(): bool
    {
        return $this->role === self::ROLE_USER;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn(string $name) => Str::of($name)->substr(0, 1)->upper())
            ->take(2)
            ->implode('');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'created_by');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

    public function joinedProjects()
    {
        return $this->belongsToMany(Project::class, 'project_members', 'user_id', 'project_id');
    }

    public function availabilities()
    {
        return $this->hasMany(MemberAvailability::class);
    }

    public function todayAvailability()
    {
        return $this->hasOne(MemberAvailability::class)->where('date', now()->toDateString());
    }

    /**
     * Get the URL for the user's profile photo.
     */
    public function getProfilePhotoUrlAttribute(): string
    {
        if ($this->hasMedia('avatars')) {
            return $this->getFirstMediaUrl('avatars');
        }

        if ($this->profile_photo_path) {
            return asset('storage/' . $this->profile_photo_path);
        }

        return "https://ui-avatars.com/api/?name=" . urlencode($this->name) . "&background=random";
    }
    public function hasPermission(string $permission): bool
    {
        // Admins can do everything (optional override, or rely on DB)
        if ($this->role === self::ROLE_ADMIN) {
            return true;
        }

        return RolePermission::where('role', $this->role)
            ->where('permission', $permission)
            ->exists();
    }

    public function getCurrentStatusAttribute(): string
    {
        return $this->todayAvailability?->status ?? 'available';
    }
}
