<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class provider extends Model
{
    protected $table = 'provider';

    public function linktoinput(){
      return $this->hasMany('App\input_sheet','id_provider','id');
    }

    public function linktoproduct(){
      return $this->hasMany('App\product','id_provider','id');
    }
}
