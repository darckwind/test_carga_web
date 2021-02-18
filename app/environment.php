<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class environment extends Model
{
    protected $fillable = [
        'env_id','env_machine_name','env_machine_os','env_path_gatling'
    ];

    public function user(){
        return $this->hasOne('App\User','id');
    }

}
