<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    public function vacancy()
    {
        return $this->hasMany(Vacancy::class);
    }
}
