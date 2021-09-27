<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetaheaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta_header', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('keyword')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('image', 255)->nullable();
            $table->tinyInteger('language_id')->nullable()->default(2);
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
        Schema::dropIfExists('meta_header');
    }
}
