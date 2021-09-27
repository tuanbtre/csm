<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaticPage extends Model
{
   use HasFactory;
   protected $table = 'tbl_staticpage';
    
   protected $fillable = [
      'id', 'pagecode', 'title', 'map', 'brief', 'content', 'image', 'htmlfile', 'keyword', 'meta_description', 'priority', 'isactive', 'isdefault', 'language_id' 
   ];
   public $timestamps = true;
}
