<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AvatarTransaction extends Model
{
    //
    protected $guarded = ['id'];

    public function avatar()
    {
        return $this->belongsTo(Avatar::class);
    }
}
