<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteLanguage extends Model
{
   use HasFactory;
   protected $table = 'route_language';
    
   protected $fillable = [
      'id', 'route_name', 'url', 'controlleract', 'method', 'middleware', 'title', 'language_id', 'parent_id' 
   ];
   public function language()
   {
      return $this->belongsTo('App\Models\Language', 'language_id', 'id');
   }
   public $timestamps = true;
}
