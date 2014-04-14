<?php

class Choice extends Eloquent {

    protected $guarded = array('');

    public function poll()
    {
        return $this->belongsTo('Poll');
    }

    public function votes()
    {
        return $this->hasMany('Vote');
    }

    public function getTotalVotesAttribute()
    {
        return $this->votes()->count();
    }

}