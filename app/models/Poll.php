<?php

class Poll extends Eloquent {

    protected $guarded = array('');

    public function choices()
    {
        return $this->hasMany('Choice');
    }

    public function votes()
    {
        return $this->hasMany('Vote');
    }
}