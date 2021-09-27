<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
   use HasFactory;
   protected $table = 'tbl_banner';
    
   protected $fillable = [
      'id', 'cat_id', 'title', 'brief', 'youtube', 'popup', 'url', 'image', 'priority', 'isactive' 
   ];
   public function bannertype()
   {
      return $this->belongsTo('App\Models\BannerType', 'cat_id', 'id');
   }
   public $timestamps = false;
}
