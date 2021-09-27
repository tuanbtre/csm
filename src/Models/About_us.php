<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About_us extends Model
{
   use HasFactory;
   protected $table = 'about_us';    
   protected $fillable = [
      'id', 'title', 'brief', 'content', 'keyword', 'meta_description', 'image', 're_name', 'priority', 'language_id', 'isdefault', 'isactive' 
   ];
   public $timestamps = true;
}
