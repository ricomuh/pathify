<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\RoleEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'profile_picture',
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

            // auto generate image by initials
            // $model->profile_picture = 'https://ui-avatars.com/api/?name=' . urlencode($model->fullname) . '&color=7F9CF5&background=EBF4FF';

            // get the picture and save it to the storage
            $picture = 'https://ui-avatars.com/api/?name=' . urlencode($model->fullname) . '&color=7F9CF5&background=EBF4FF';

            $filename = 'profiles/' . $model->id . '.jpg';
            $path = storage_path('app/public/images/' . $filename);

            file_put_contents($path, file_get_contents($picture));

            $model->profile_picture = asset('storage/images/' . $filename);

            if (!$model->username || empty($model->username)) {

                $found = true;
                $username = str($model->fullname)->lower()->slug('_');

                while ($found) {
                    $found = User::where('username', $username)->exists();
                    if ($found) {
                        $username = $username . '_' . str()->random(3);
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
