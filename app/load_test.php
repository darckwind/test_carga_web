<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class load_test extends Model
{
    protected $fillable = [
        'load_test_id','load_test_name','load_test_base_url','load_test_post_url','load_test_num_usr','load_test_ramp_usr','load_test_rand_anws','load_test_csv_token','load_test_file_charge','env_id'
    ];

    protected $primaryKey = 'load_test_id';

    public function environment(){
        return $this->hasOne('App\environment','env_id');
    }
}