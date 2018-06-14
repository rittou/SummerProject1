<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bill extends Model
{
    protected $table = 'bill';

    public function linktousers(){
      return $this->belongsTo('App\users','id_users','id');
    }

    public function linktobilldetail(){
      return $this->hasMany('App\bill_detail','id_bill','id');
    }

    public function linktopayment(){
      return $this->hasOne('App\payment','id','id_payment');
    }
}
