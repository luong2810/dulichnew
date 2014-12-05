<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MemberAccount extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		 Schema::create('member_account',
                       function($table)
                       {
                           $table->engine = 'InnoDB';

                           $table->increments('id');
                           $table->string('user_name');
                           $table->string('password');
                           $table->string('email');
                           $table->string('type_member');

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
		Schema::drop('member_account');
	}

}
