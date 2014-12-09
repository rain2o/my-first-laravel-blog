<?php


class Comment extends Eloquent {

    protected $fillable = array('commenter', 'comment');
 
    public function post() {
        return $this->belongsTo('Post');
    }
}

?>