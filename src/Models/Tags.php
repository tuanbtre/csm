<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
   use HasFactory;
   protected $table = 'tags';
    
  	protected $fillable = [
      'id', 'tag_name', 're_name' 
   ];
   public $timestamps = false;
   
   public function news()
   {
      return $this->morphedByMany('App\Models\News', 'taggable');
   }      
}
