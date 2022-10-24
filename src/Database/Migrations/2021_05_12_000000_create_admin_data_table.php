<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('users');
		Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username');
            $table->string('image', 255)->nullable();
            $table->tinyInteger('isadmin')->default(0);
            $table->string('email', 190)->unique();
			$table->string('phone', 20)->nullable();
			$table->string('address', 255)->nullable();
			$table->tinyInteger('isactive')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken()->nullable();
            $table->timestamps();
        });
		Schema::create('route_language', function (Blueprint $table) {
            $table->id();
			$table->string('route_name', 255);
			$table->string('title', 255);
			$table->integer('parent_id')->default(0);
			$table->string('controlleract', 255)->nullable();
			$table->string('url', 255)->nullable();
			$table->string('middleware', 255)->nullable();
			$table->string('method', 255);
			$table->tinyInteger('language_id');
            $table->timestamps();
        });
		Schema::create('tbl_function', function (Blueprint $table) {
            $table->id();
			$table->string('icon', 255)->nullable();
			$table->string('controlleract', 255)->nullable();
			$table->string('url', 255)->nullable();
			$table->string('method', 255)->nullable();
			$table->string('title_en', 255)->nullable();
			$table->string('title_vn', 255);
			$table->string('description', 255)->nullable();
			$table->string('function_tab', 255)->nullable();
			$table->string('route_name', 255)->nullable();
			$table->tinyInteger('can_grant')->default(0);
			$table->tinyInteger('isshow')->default(0);
			$table->integer('parent_id')->default(0);
            $table->timestamps();
        });
		Schema::create('tbl_language', function (Blueprint $table) {
            $table->id();
			$table->string('lang_name', 255)->nullable();
			$table->string('url_name', 255)->nullable();
			$table->string('flag', 50)->nullable();			
        });
		Schema::create('tbl_permission', function (Blueprint $table) {
            $table->id();
			$table->foreignId('user_id')->constrained('users')->onDelete('cascade');
			$table->foreignId('function_id')->constrained('tbl_function')->onDelete('cascade');
            $table->timestamps();
        });
		Schema::create('meta_header', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('keyword')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('image', 255)->nullable();
            $table->tinyInteger('language_id')->nullable()->default(2);
            $table->timestamps();
        });
		Schema::create('tbl_pagging', function (Blueprint $table) {
            $table->id();
			$table->string('title', 255);
			$table->string('route_name', 255)->nullable();
			$table->integer('numofpage')->default(1);
			$table->tinyInteger('language_id')->default(2);
			$table->integer('priority')->default(1);
            $table->timestamps();
        });
		Schema::create('tbl_staticpage', function (Blueprint $table) {
            $table->id();
			$table->string('title', 255);
			$table->string('map', 255)->nullable();
			$table->string('pagecode', 255);
			$table->text('brief')->nullable();
			$table->text('content')->nullable();
			$table->string('image', 255)->nullable();
			$table->string('htmlfile', 255)->nullable();
			$table->text('keyword')->nullable();
			$table->text('meta_description')->nullable();
			$table->tinyInteger('language_id')->default(2);
			$table->integer('priority')->default(1);
			$table->tinyInteger('isdefault')->default(0);
			$table->tinyInteger('isactive')->default(0);
            $table->timestamps();
        });
		Schema::create('tbl_mailmanager', function (Blueprint $table) {
            $table->id();
			$table->string('email', 255);
			$table->integer('type');
            $table->timestamps();
        });
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
		Schema::create('banner_type', function (Blueprint $table) {
            $table->id();
			$table->string('title', 255);
			$table->string('group', 255)->nullable();
			$table->tinyInteger('type')->nullable()->default(2)->comment('1=>video, 2=>image');
			$table->tinyInteger('language_id')->default(2);
			$table->integer('priority')->default(1);
			$table->tinyInteger('isactive')->default(0);
            $table->timestamps();
        });
		Schema::create('tbl_banner', function (Blueprint $table) {
            $table->id();
			$table->string('title', 255);
			$table->string('pagecode', 255)->nullable();
			$table->string('youtube', 255)->nullable();
			$table->string('url', 255)->nullable();
			$table->text('brief', 255)->nullable();
			$table->string('image', 255)->nullable();
			$table->foreignId('cat_id')->constrained('banner_type')->onDelete('cascade');
			$table->tinyInteger('popup')->nullable()->default(0);
			$table->tinyInteger('language_id')->default(2);
			$table->integer('priority')->default(1);
			$table->tinyInteger('isactive')->default(0);
            $table->timestamps();
        });
		Schema::create('tags', function (Blueprint $table) {
            $table->id();
			$table->string('tag_name', 255);
			$table->string('re_name', 255)->nullable();
            $table->timestamps();
        });
		Schema::create('taggables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tags_id');
            $table->unsignedBigInteger('taggable_id');
			$table->string('taggable_type', 255);
            $table->timestamps();
        });
		Schema::create('news_cat', function (Blueprint $table) {
            $table->id();
			$table->string('title', 255);
			$table->string('image', 255)->nullable();
			$table->string('re_name', 255);
			$table->tinyInteger('language_id')->default(2);
			$table->integer('priority')->default(1);
			$table->tinyInteger('isactive')->default(0);
            $table->timestamps();
        });
		Schema::create('news', function (Blueprint $table) {
            $table->id();
			$table->foreignId('cat_id')->constrained('news_cat')->onDelete('cascade');
			$table->string('title', 255);
			$table->text('brief')->nullable();
			$table->longText('content')->nullable();
			$table->string('tag', 255)->nullable();
			$table->text('keyword')->nullable();
			$table->text('meta_description')->nullable();
			$table->string('image', 255)->nullable();
			$table->string('re_name', 255);
			$table->tinyInteger('ishot')->default(0);
			$table->tinyInteger('isdefault')->default(0);
			$table->integer('priority')->default(1);
			$table->tinyInteger('isactive')->default(0);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
        });
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
		Schema::create('advertisement', function (Blueprint $table) {
            $table->id();
			$table->string('title', 255);
			$table->text('brief')->nullable();
			$table->string('url', 255)->nullable();
			$table->tinyInteger('new_tab')->nullable()->default(0);
			$table->string('image', 255)->nullable();
			$table->unsignedBigInteger('group')->nullable();
			$table->tinyInteger('language_id')->default(2);
			$table->integer('priority')->default(1);
			$table->tinyInteger('isactive')->default(0);
            $table->timestamps();
        });
		Schema::create('about_us', function (Blueprint $table) {
            $table->id();
			$table->string('title', 255);
			$table->text('brief')->nullable();
			$table->longText('content')->nullable();
			$table->text('keyword')->nullable();
			$table->text('meta_description')->nullable();
			$table->string('image', 255)->nullable();
			$table->string('re_name', 255);
			$table->tinyInteger('isdefault')->default(0);
			$table->integer('priority')->default(1);
			$table->tinyInteger('isactive')->default(0);
			$table->tinyInteger('language_id')->default(2);
            $table->timestamps();
        });
		Schema::create('config_mailsmtp', function (Blueprint $table) {
            $table->id();
			$table->string('mail_host', 255);
			$table->string('mail_port', 255);
			$table->string('username', 255);
			$table->string('password', 255);
			$table->string('encryption', 255)->nullable();
			$table->string('from_address', 255)->nullable();
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
        Schema::dropIfExists('users');
		Schema::dropIfExists('route_language');
		Schema::dropIfExists('tbl_function');
		Schema::dropIfExists('tbl_language');
		Schema::dropIfExists('tbl_permission');
		Schema::dropIfExists('meta_header');
		Schema::dropIfExists('tbl_pagging');
		Schema::dropIfExists('tbl_staticpage');
		Schema::dropIfExists('tbl_mailmanager');
		Schema::dropIfExists('tbl_companyinfo');
		Schema::dropIfExists('banner_type');
		Schema::dropIfExists('tbl_banner');
		Schema::dropIfExists('tags');
		Schema::dropIfExists('taggables');
		Schema::dropIfExists('news_cat');
		Schema::dropIfExists('news');
		Schema::dropIfExists('contact_mail');
		Schema::dropIfExists('advertisement');
		Schema::dropIfExists('about_us');
		Schema::dropIfExists('config_mailsmtp');
    }
}
