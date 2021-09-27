<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailManager extends Model
{
   use HasFactory;
   protected $table = 'tbl_mailmanager';
    
   protected $fillable = [
      'id', 'email', 'type' 
   ];
}
