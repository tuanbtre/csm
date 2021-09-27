<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsType extends Model
{
   use HasFactory;
   protected $table = 'news_cat';
    
   protected $fillable = [
      'id', 'title', 'image', 'language_id', 're_name', 'priority', 'isactive' 
   ];

   public function news(){
    	return $this->hasMany('App\Models\News', 'cat_id', 'id');
   }
   public $timestamps = false;
}
