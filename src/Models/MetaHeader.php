<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaHeader extends Model
{
   use HasFactory;
   protected $table = 'meta_header';
    
   protected $fillable = [
      'title', 'keyword', 'meta_description' 
   ];
}
