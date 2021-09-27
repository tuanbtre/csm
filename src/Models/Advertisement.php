<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
   use HasFactory;
   protected $table = 'advertisement';
    
   protected $fillable = [
      'id', 'title', 'brief', 'url','new_tab', 'group', 'image', 'priority', 'isactive', 'language_id' 
   ];
   public $timestamps = false;
}
