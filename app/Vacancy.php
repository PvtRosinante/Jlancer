<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }
}
