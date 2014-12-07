<?php

class Post extends Eloquent {

    protected $fillable = array('title', 'content', 'author');
    
    public function user() {
        return $this->belongsTo('User','author');
    }
 
    public function comments() {
        return $this->hasMany('Comment');
    }
 
}
?>