<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PhysicalCustomer;
use App\Models\User;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'paintCategory',
        'paintType',
        'capacity',
        'quantity',
        'paintcolor',
        'needs_painter',
        'description',
        'order_type',
        'status',
        'total_price',
       

    ];
     

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
