<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigMailSMTP extends Model
{
    use HasFactory;
	protected $table = 'config_mailsmtp';

   protected $fillable = [
      'id', 'mail_host', 'mail_port', 'username', 'password', 'encryption', 'from_address' 
   ];
    
   public $timestamps = true;
}
