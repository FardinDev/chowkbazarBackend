<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBasicInfosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('basic_infos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('logo', 65535)->nullable();
			$table->text('phone_number', 65535)->nullable();
			$table->text('email_id', 65535)->nullable();
			$table->text('facebook_link', 65535)->nullable();
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
		Schema::drop('basic_infos');
	}

}
