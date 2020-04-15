<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSourceProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('source_products', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->text('user_name', 65535);
			$table->text('user_phone', 65535);
			$table->text('product_name', 65535)->nullable();
			$table->text('product_quantity', 65535)->nullable();
			$table->text('product_description', 65535)->nullable();
			$table->text('product_url', 65535)->nullable();
			$table->text('product_images', 65535)->nullable();
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
		Schema::drop('source_products');
	}

}
