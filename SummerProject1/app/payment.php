<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    protected $table = 'payment';

    public function linktobill(){
      return $this->belongsTo('App\bill','id_payment','id');
    }
}
