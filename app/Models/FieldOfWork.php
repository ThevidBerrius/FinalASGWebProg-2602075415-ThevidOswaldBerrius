<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FieldOfWork extends Model
{
    //

    protected $table = 'field_of_works';

    protected $guarded = ['id'];

    public function userFOW(){
        return $this->hasMany(UserFOW::class);
    }
}
