<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class Movement extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'user_id',
        'fail_id',
        'date_movement',
        'return_estimate_date',
        'return_date', 
        'note'
    ];


    public function fails(){
        return $this->belongsTo('App\Models\Fail','fail_id');
    }

    public function users(){
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function kulits(){
        return $this->belongsTo('App\Models\Kulit','kulit_id')->withDefault();;
    }

     
}
