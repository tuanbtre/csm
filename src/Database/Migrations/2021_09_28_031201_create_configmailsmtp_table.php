<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigmailsmtpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_mailsmtp', function (Blueprint $table) {
            $table->id();
			$table->string('mail_host', 255);
			$table->string('mail_port', 255);
			$table->string('username', 255);
			$table->string('password', 255);
			$table->string('encryption', 255)->default(null)->nullable();
			$table->string('from_address', 255)->default(null)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('config_mailsmtp');
    }
}
