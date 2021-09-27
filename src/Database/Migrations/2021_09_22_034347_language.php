<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Language extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('tbl_language', function (Blueprint $table) {
            $table->id();
			$table->string('lang_name', 255)->nullable()->default(null);
			$table->string('url_name', 255)->nullable()->default(null);
			$table->string('flag', 50)->nullable()->default(null);			
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('tbl_language');
    }
}
