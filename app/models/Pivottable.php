<?php

class Pivottable extends Eloquent {

	 public function result()
    {
        return $this->hasMany('Result', 'pivot_id');
    }

}
