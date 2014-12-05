<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MemberAction extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		 Schema::create('member_action',
                       function($table)
                       {
                           $table->engine = 'InnoDB';

                           $table->increments('id');
                           $table->string('type_action');
                           $table->integer('user_id');
                           $table->integer('group_id');
                           $table->integer('service_id');
                           $table->integer('posts_id');
                           $table->integer('comment_id');
                           $table->integer('image_id');

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
		Schema::drop('member_action');
	}


}
