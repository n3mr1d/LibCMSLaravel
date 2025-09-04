<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable 
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'role',
        'user_agent',
        'ip_address',
        'password',
        'last_login_at',
    ];

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
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Set the user's password, always hashing it.
     */
    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Hash::needsRehash($value) ? Hash::make($value) : $value,
        );
    }

    /**
     * Scope a query to only include admins.
     */
    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    /**
     * Scope a query to only include guests.
     */
    public function scopeGuests($query)
    {
        return $query->where('role', 'guest');
    }

    /**
     * Check if the user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->role == 'admin';
    }

    /**
     * Check if the user is a guest.
     */
    public function isGuest(): bool
    {
        return $this->role == 'guest';
    }

    /**
     * Get the user's initials (up to 2 words).
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->filter()
            ->take(2)
            ->map(fn ($word) => Str::upper(Str::substr($word, 0, 1)))
            ->implode('');
    }

    /**
     * Get a display name for the user.
     */
    public function displayName(): string
    {
        return $this->name ?: $this->username ?: $this->email;
    }

    /**
     * Update the user's last login information.
     */
    public function updateLoginInfo($ip = null, $userAgent = null)
    {
        $this->last_login_at = now();
        $this->ip_address = $ip ?? request()->ip();
        $this->user_agent = $userAgent ?? request()->userAgent();
        $this->save();
    }

    /**
     * Get a short user info array.
     */
    public function shortInfo(): array
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'display_name' => $this->displayName(),
            'role' => $this->role,
            'initials' => $this->initials(),
        ];
    }

    /**
     * Determine if the user is the currently authenticated user.
     */
    public function isCurrent(): bool
    {
        return Auth::check() && Auth::id() === $this->id;
    }
}