<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('书名');
            $table->string('author')->comment('作者');
            $table->integer('cate_id')->comment('分类的ID');
            $table->text('intro')->comment('书的简介');
            $table->string('img')->comment('书的封面图');
            $table->integer('last')->comment('库存');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('books');
    }
}
