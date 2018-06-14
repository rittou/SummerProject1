<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    protected $table = 'comment';

    public function linktouser(){
      return $this->belongsTo('App\User','id_User','id');
    }

    public function linktoproduct(){
      return $this->belongsTo('App\product','id_product','id');
    }

}
