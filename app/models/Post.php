<?php

class Post extends Eloquent {

    public function user() {
        return $this->belongsTo('User','author');
    }
 
    public function comments() {
        return $this->hasMany('Comment');
    }
 
}
?>