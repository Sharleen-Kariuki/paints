<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PhysicalCustomer;
use App\Models\User;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'paintCategory',
        'paintType',
        'capacity',
        'quantity',
        'paintcolor',
        'order_type',
        'status',
        'total_price',
       

    ];
    //order flow
 

     

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stockNeeded(){
        return $this->hasMany(stockNeeded::class);
    }


}
