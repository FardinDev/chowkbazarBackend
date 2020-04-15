<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductQueriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_queries', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('product_id');
			$table->text('user_name', 65535);
			$table->text('phone_number', 65535);
			$table->text('product_query', 65535);
			$table->boolean('is_read')->default(0);
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
		Schema::drop('product_queries');
	}

}
