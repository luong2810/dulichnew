<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Trademark extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		 Schema::create('trademark',
                       function($table)
                       {
                           $table->engine = 'InnoDB';

                           $table->increments('id');
                           $table->string('trademark_name');
                           $table->string('description');
                           $table->string('logo');
                           $table->integer('user_id');

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
		Schema::drop('trademark');
	}

}
