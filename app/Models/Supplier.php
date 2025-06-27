<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'Company_name',
        'phone',
        'address',
        'material_bought',
        'amount_paid',
        'quantity',
        'unit_price'
    ];

}
