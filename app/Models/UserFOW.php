<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFOW extends Model
{
    //
    protected $table = 'user_f_o_w_s';

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function fieldOfWork(){
        return $this->belongsTo(FieldOfWork::class, 'field_of_work_id');
    }
}
