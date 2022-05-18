<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
			$table->string('name', 191);
			$table->double('price');
			$table->text('description');
			$table->foreignId('category_id')
				->nullable()
				->default(null)
				->references('id')
				->on('categories')
				->onDelete('set null')
				->onUpdate('no action');
			$table->boolean('available')->default(true);
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
		Schema::table('products', function (Blueprint $table) {
			$table->dropConstrainedForeignId('category_id');
		});
        Schema::dropIfExists('products');
    }
};
