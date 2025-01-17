<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    protected $table = 'notifications';
    
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sender(){
        return $this->belongsTo(User::class, 'sender_id');
    }
}
