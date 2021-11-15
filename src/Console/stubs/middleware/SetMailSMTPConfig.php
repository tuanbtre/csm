<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SetMailSMTPConfig
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $mailsmtp = DB::table('config_mailsmtp')->first();
		if($mailsmtp)
		{
			$config = [
				'driver' => 'smtp',
				'host' => $mailsmtp->mail_host,
				'port' => $mailsmtp->mail_port,
				'encryption' => $mailsmtp->encryption,
				'from' => array('address' => $mailsmtp->from_address, 'name' => env('MAIL_FROM_NAME', 'Example')),
				'username' => $mailsmtp->username,
				'password' => $mailsmtp->password
			];

			\Config::set('mail', $config);
		}			
		return $next($request);
    }
}
