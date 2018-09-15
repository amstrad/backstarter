<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';
    //protected $primaryKey = 'id';
    protected $fillable = [

    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
