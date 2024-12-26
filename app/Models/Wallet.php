<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
   protected $table = "wallet";

   protected $fillable = [
    'user_id','wallet_amount','wallet_type','game_status','created_by','updated_by','trash',
   ];
}
