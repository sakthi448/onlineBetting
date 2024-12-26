<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
     'user_id','entry_amount','total_amount','select_value','winning_value','created_by','updated_by',
    ];
}
