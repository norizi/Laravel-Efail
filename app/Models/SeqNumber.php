<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeqNumber extends Model
{
    use HasFactory;

    protected $table = 'seq_numbers';
    protected $fillable = [
        'seq_no', 
        'fail_id'
    ];

     

}
