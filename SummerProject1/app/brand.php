<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    protected $table = 'brand';

    public function linktoproduct(){
      return $this->hasMany('App\product','id_brand','id');
    }

}
