<?php

class Vote extends Eloquent {

    protected $guarded = array('');

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function poll()
    {
        return $this->belongsTo('Poll');
    }

    public function choice()
    {
        return $this->belongsTo('Choice');
    }


}