<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'material_controllers';
     protected $fillable = [
        'name',
        'unit',
        'stock_qty',
        'reorder_level',
    ];
}
