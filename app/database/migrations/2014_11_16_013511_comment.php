<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Comment extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		 Schema::create('comment',
                       function($table)
                       {
                           $table->engine = 'InnoDB';

                           $table->increments('id');
                           $table->string('content');
                           $table->string('user_id');
                           $table->string('posts_id');
                           $table->string('image_id');
                           $table->string('reply_of_id');

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
		//
		Schema::drop('comment');
	}


}
