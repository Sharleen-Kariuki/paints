<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhysicalOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'paintCategory',
        'paintType',
        'capacity',
        'quantity',
        'paintcolor',
        'needs_painter',
        'description',
        'status',
    ];

   
}
