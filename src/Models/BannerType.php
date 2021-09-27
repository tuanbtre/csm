<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerType extends Model
{
   use HasFactory;
   protected $table = 'banner_type';
    
   protected $fillable = [
       'id', 'title', 'group', 'type', 'priority', 'isactive', 'language_id' 
   ];
   public function banner(){
    	return $this->hasMany('App\Models\Banner', 'cat_id', 'id');
   }
   public $timestamps = false;
}
