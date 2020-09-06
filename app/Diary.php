<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'id','subject','date_and_time','customer_dni','status_id',
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_dni','dni');
    }
    public function status()
    {
        return $this->belongsTo(Status::class,'status_id','id');
    }

}
