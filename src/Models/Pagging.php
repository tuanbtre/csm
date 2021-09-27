<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagging extends Model
{
   use HasFactory;
   protected $table = 'tbl_pagging';
    
   protected $fillable = [
      'id', 'title', 'route_name', 'priority', 'numofpage', 'language_id' 
   ];
   public $timestamps = true;
}
