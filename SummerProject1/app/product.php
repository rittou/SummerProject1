<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table = 'product';

    public function linktobrand(){
      return $this->belongsTo('App\brand','id_brand','id');
    }

    public function linktotype(){
      return $this->belongsTo('App\type_product','id_type','id');
    }

    public function linktocomment(){
      return $this->hasMany('App\comment','id_product','id');
    }

    public function linktoimage(){
      return $this->hasMany('App\product_images','id_product','id');
    }

    public function linktobilldetail(){
      return $this->belongsTo('App\bill_detail','id_product','id');
    }

    public function linktoprovider(){
      return $this->belongsTo('App\provider','id_provider','id');
    }
}
