<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class Fail extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'ref_no',
        'kulit_id',
        'title',
        'typefail_id',
        'status_id',
        'desc_fail'
    ];


    public function status(){
        return $this->belongsTo('App\Models\Status','status_id');
    }

    public function type_fails(){
        return $this->belongsTo('App\Models\TypeFail','typefail_id');
    }

    public function kulits(){
        return $this->belongsTo('App\Models\Kulit','kulit_id')->withDefault();;
    }

     
}
