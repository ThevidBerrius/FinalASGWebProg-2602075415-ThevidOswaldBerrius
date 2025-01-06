<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    //
    protected $table = 'avatars';

    protected $guarded = ['id'];

    public function getImageDataAttribute()
    {
        return 'data:image/png;base64,' . base64_encode($this->image);
    }

    public function avatarTransactions()
    {
        return $this->hasMany(AvatarTransaction::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'avatar_transactions')->withTimestamps();
    }

}
