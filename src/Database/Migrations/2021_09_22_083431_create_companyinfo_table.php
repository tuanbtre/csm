<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_companyinfo', function (Blueprint $table) {
            $table->id();
			$table->string('title', 255)->nullable();
			$table->string('code', 255)->nullable();
			$table->string('link', 255)->nullable();
			$table->text('content')->nullable();
			$table->string('image', 255)->nullable();
			$table->string('font_icon', 255)->nullable();
			$table->tinyInteger('language_id')->default(2);
			$table->integer('priority')->default(1);
			$table->tinyInteger('isactive')->default(0);
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
        Schema::dropIfExists('tbl_companyinfo');
    }
}
