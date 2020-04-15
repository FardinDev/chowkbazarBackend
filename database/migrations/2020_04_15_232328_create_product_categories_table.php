<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_categories', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->text('name', 65535);
			$table->text('slug', 65535);
			$table->integer('parent_id')->nullable();
			$table->text('image', 65535)->nullable();
			$table->boolean('is_popular')->default(0);
			$table->integer('item_count')->default(0);
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
		Schema::drop('product_categories');
	}

}
