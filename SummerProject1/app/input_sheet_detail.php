<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class input_sheet_detail extends Model
{
    protected $table = 'input_sheet_detail';

    public function linktoinput(){
      return $this->belongsTo('App\input_sheet','id_input_sheet','id');
    }

}
