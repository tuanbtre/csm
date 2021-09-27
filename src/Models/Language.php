<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
   use HasFactory;
   protected $table = 'tbl_language';
    
   protected $fillable = [
      'id', 'lang_name', 'url_name' 
   ];
}
