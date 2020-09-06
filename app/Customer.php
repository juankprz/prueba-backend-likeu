<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $primaryKey = 'dni';

    protected $fillable = [
        'dni','name','lastname','date_of_birth','email','phone'
    ];

        public function diaries()
        {
            return $this->hasMany(Diary::class);
        }

}
