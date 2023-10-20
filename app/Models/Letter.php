<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'seq_no',
        'in_out',
        'letter',
        'sent_to',
        'sent_from',
        'ref_letter',
        'date_letter',
        'fail_id', 
        'created_by', 
        'update_by', 
    ];

    public function fails(){
        return $this->belongsTo('App\Models\Fail','fail_id');
    }

    public function users(){
        return $this->belongsTo('App\Models\User','created_by');
    }


    

     
}
