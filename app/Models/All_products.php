<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class All_products extends Model
{
    use HasFactory;

    protected $table = '_all__products';

    protected $fillable=[
        'Name','Price',"Image",'Exclusive','Available'
    ];
}
