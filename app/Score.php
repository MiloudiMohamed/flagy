<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $guarded = [];
    protected $appends = ['human_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }



    public function getHumanDateAttribute() {
        return $this->created_at->diffForHumans();
    }
}
