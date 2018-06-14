<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class input_sheet extends Model
{
    protected $table = 'input_sheet';

    public function linktoadmin(){
      return $this->belongsTo('App\admin','id_admin','id');
    }

    public function linktoinputdetail(){
      return $this->hasOne('App\input_sheet_detail','id_input_sheet','id');
    }

    public function linktoprovider(){
      return $this->belongsTo('App\provider','id_provider','id');
    }
}
