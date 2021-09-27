<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMail extends Model
{
   use HasFactory;
   protected $table = 'contact_mail';    
   protected $fillable = [
      'id', 'title', 'email', 'content', 'address', 'phone', 'fullname', 'company'
   ];
   public $timestamps = true;
}
