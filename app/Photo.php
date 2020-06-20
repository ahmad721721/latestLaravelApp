<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    protected $uploads = "/images/";
    protected $fillable = ['file'];

    //accessor
    //before picking photo from db it puts $uploads="/images/" value before
    public function getFileAttribute($photo){
        return $this->uploads.$photo;
    }
}
