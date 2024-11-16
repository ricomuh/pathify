<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\RoleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'fullname',
        'username',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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

    // auto generate uuid when creating a new user
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = str()->uuid();

            if (!$model->username) {

                $found = false;

                while (!$found) {
                    $username = str($model->fullname)->slug('_');

                    $user = User::where('username', $username)->first();

                    if ($user) {
                        $username = str($username . '_' . str()->random(5))->slug('_');
                    } else {
                        $found = true;
                    }
                }

                $model->username = $username;
            }
        });
    }

    /**
     * Get the role that the user belongs to.
     */
    public function role(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the role name attribute.
     */
    public function getRoleNameAttribute(): string
    {
        return $this->role->name;
    }

    /**
     * Determine if the user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->role_id === RoleEnum::Admin;
    }

    /**
     * Determine if the user is a mentor.
     */
    public function isMentor(): bool
    {
        return $this->role_id === RoleEnum::Mentor;
    }

    /**
     * Determine if the user is a user.
     */
    public function isUser(): bool
    {
        return $this->role_id === RoleEnum::User;
    }

    /**
     * Check if the user has a role.
     */
    public function hasRole(int $role): bool
    {
        return $this->role_id === $role;
    }
}
