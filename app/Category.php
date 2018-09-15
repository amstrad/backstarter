<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //protected $table = 'categories';
    //protected $primaryKey = 'id';
    protected $fillable = ['name','description','state'];

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

}
