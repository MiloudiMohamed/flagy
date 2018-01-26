<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flag extends Model
{
    protected $guarded = [];

    protected $appends = ['path'];


    public function getPathAttribute() {
        return asset('images/flags'). '/' . $this->code . '.png';
    }
}
