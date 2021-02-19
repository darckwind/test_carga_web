<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class environment extends Model
{
    protected $fillable = [
        'env_id','env_machine_name','env_machine_os','env_thread','env_ram','env_server'
    ];
    protected $primaryKey = 'env_id';

    public function user(){
        return $this->hasOne('App\User','id');
    }

}
