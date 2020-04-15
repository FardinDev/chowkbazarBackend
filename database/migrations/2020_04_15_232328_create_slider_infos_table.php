<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSliderInfosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('slider_infos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->text('title', 65535)->nullable();
			$table->text('subtitle', 65535)->nullable();
			$table->text('short_description', 65535)->nullable();
			$table->text('button_text', 65535)->nullable();
			$table->text('button_url', 65535)->nullable();
			$table->text('main_image', 65535)->nullable();
			$table->text('pricing_image', 65535)->nullable();
			$table->boolean('is_active')->nullable();
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
		Schema::drop('slider_infos');
	}

}
