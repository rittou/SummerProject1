<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product_images extends Model
{
    protected $table ='product_images';

    public function linktoproduct(){
      return $this->belongsTo('App\product','id_product','id');
    }
}
