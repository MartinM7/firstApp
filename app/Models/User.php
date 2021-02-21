<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function media()
    {
        return $this->hasMany(Media::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function blockedUserIds()
    {
        $collect = $this->blockedByUsers()->pluck('id');

        return $this->blockedUsers()->pluck('id')->merge($collect)->unique()->toArray();
    }

    public function blockUser(User $user)
    {
        return $this->blockedUsers()->save($user);
    }

    public function toggleBlockUser(User $user)
    {
        return $this->blockedUsers()->toggle($user);
    }

    public function isBlocked(User $user)
    {
        return $this->blockedUsers()->where('blocked_user_id', $user->id)->exists();
    }

    public function blockedUsers()
    {
        return $this->belongsToMany(User::class, 'blocked_users', 'user_id', 'blocked_user_id');
    }

    public function blockedByUsers()
    {
        return $this->belongsToMany(User::class, 'blocked_users', 'blocked_user_id', 'user_id');
    }
}
