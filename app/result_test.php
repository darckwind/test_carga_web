<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class result_test extends Model
{
    protected $fillable = [
        'result_test_id','result_test_path','load_test_id'
    ];

    protected $primaryKey = 'result_test_id';

    public function load_test(){
        return $this->belongsTo('App\load_test','load_test_id');
    }
}
