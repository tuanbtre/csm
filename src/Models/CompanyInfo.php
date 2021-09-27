<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
   use HasFactory;
   protected $table = 'tbl_companyinfo';
    
   protected $fillable = [
      'id', 'title', 'code', 'link', 'content', 'image', 'font_icon', 'isactive', 'priority', 'language_id' 
   ];
   public $timestamps = false;
}
