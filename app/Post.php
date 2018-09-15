<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //protected $table = 'posts';
    //protected $primaryKey = 'id';
    protected $fillable =[
        'idcategory','name','description','active'
    ];
    public function categoria(){
        return $this->belongsTo('App\Category');
    }
}
