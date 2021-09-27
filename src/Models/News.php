<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
   use HasFactory;
   protected $table = 'news';

   protected $fillable = [
      'id', 'cat_id', 'title', 'brief', 'content', 'tag', 'keyword', 'meta_description', 'image', 're_name', 'priority', 'isactive', 'ishot', 'isdefault' 
   ];
    
   public function newscat()
   {
      return $this->belongsTo('App\Models\NewsType', 'cat_id', 'id');
   }
   public function tags()
   {
      return $this->morphToMany('App\Models\Tags', 'taggable');
   }
   public $timestamps = true;
}
