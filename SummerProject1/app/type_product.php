<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class type_product extends Model
{
    protected $table = 'type_product';

    public function linktoproduct(){
      return $this->hasMany('App\product','id_type','id');
    }
}
