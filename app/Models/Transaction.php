<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['product_id','change_type','quantity_changed','user_id','reason'];
}
