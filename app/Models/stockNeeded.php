<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class stockNeeded extends Model
{

    protected $fillable = [
          'id',
          'order_id',
          'material_name',
          'quantity'
           
    ];

    public function order()
{
    return $this->belongsTo(Order::class);
}

}
