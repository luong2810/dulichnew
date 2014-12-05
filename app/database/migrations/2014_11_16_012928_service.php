<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Service extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		 Schema::create('service',
                       function($table)
                       {
                           $table->engine = 'InnoDB';

                           $table->increments('id');
                           $table->string('service_name');
                           $table->string('type_service');
                           $table->string('description');
                           $table->string('location');
                           $table->integer('trademark_id');

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
		Schema::drop('service');
	}

}
