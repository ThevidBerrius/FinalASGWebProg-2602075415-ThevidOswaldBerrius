<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $guarded = ['id'];

    public function occupation()
    {
        return $this->belongsTo(Occupation::class);
    }

    public function userFOW()
    {
        return $this->hasMany(UserFOW::class);
    }

    public function friend()
    {
        return $this->hasMany(Friend::class);
    }

    public function notification()
    {
        return $this->hasMany(Notification::class);
    }

    public function avatarTransactions()
    {
        return $this->hasMany(AvatarTransaction::class);
    }

    public function avatars()
    {
        return $this->belongsToMany(Avatar::class, 'avatar_transactions')->withTimestamps();
    }

    public function avatar()
    {
        return $this->belongsTo(Avatar::class)->withDefault([
            'image_data' => asset('default-avatar.png')
        ]);
    }



    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'occupation_id',
        'gender',
        'linkedin_username',
        'phone_number',
        'experience_years',
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
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
