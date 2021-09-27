<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactmailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_mail', function (Blueprint $table) {
            $table->id();
			$table->string('title', 255)->nullable();
			$table->string('fullname', 255);
			$table->string('address', 255)->nullable();			
			$table->string('phone', 255);			
			$table->string('email', 255);			
			$table->string('company', 255)->nullable();
			$table->text('content')->nullable();	
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
        Schema::dropIfExists('contact_mail');
    }
}
