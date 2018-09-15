<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;


class Post extends Model implements HasMedia
{
    use HasMediaTrait;

    //protected $table = 'posts';
    //protected $primaryKey = 'id';
    protected $fillable =[

    ];
    public function categoria(){
        return $this->belongsTo('App\Category');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10);

        $this->addMediaConversion('original')->keepOriginalImageFormat();
    }
}
