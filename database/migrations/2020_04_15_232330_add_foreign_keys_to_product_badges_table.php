<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProductBadgesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('product_badges', function(Blueprint $table)
		{
			$table->foreign('product_id', 'product_badges_ibfk_1')->references('id')->on('products')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('badge_id', 'product_badges_ibfk_2')->references('id')->on('badges')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('product_badges', function(Blueprint $table)
		{
			$table->dropForeign('product_badges_ibfk_1');
			$table->dropForeign('product_badges_ibfk_2');
		});
	}

}
