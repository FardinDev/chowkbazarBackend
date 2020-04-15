<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->text('web_url', 65535)->nullable();
			$table->integer('type')->nullable()->default(0);
			$table->text('name', 65535)->nullable();
			$table->text('slug', 65535)->nullable();
			$table->text('brand', 65535)->nullable();
			$table->integer('category_id');
			$table->text('primary_image', 65535)->nullable();
			$table->text('other_images', 65535)->nullable();
			$table->text('description')->nullable();
			$table->text('minimum_orders', 65535);
			$table->text('unit', 65535)->nullable();
			$table->float('start_price', 10, 0);
			$table->float('end_price', 10, 0);
			$table->boolean('is_featured')->default(0);
			$table->text('tags', 65535)->nullable();
			$table->integer('views')->default(0);
			$table->text('text_one_title', 65535)->nullable();
			$table->text('text_one_text', 65535)->nullable();
			$table->text('text_two_title', 65535)->nullable();
			$table->text('text_two_text', 65535)->nullable();
			$table->text('text_three_title', 65535)->nullable();
			$table->text('text_three_text', 65535)->nullable();
			$table->text('text_four_title', 65535)->nullable();
			$table->text('text_four_text', 65535)->nullable();
			$table->text('text_five_title', 65535)->nullable();
			$table->text('text_five_text', 65535)->nullable();
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
		Schema::drop('products');
	}

}
