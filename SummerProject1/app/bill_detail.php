<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bill_detail extends Model
{
    protected $table = 'bill_detail';

    public function linktoproduct(){
      return $this->hasOne('App\product','id','id_product');
    }

    public function linktobill(){
      return $this->belongsTo('App\bill','id_bill','id');
    }
}
