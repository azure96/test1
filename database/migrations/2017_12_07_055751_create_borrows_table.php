<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBorrowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrows', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('book_id')->comment('书编号');
            $table->string('bookname')->comment('书名');
            $table->integer('cate_id')->comment('分类的ID');
            $table->integer('user_id')->comment('用户的ID');
            $table->time('return_time')->nullable()->comment('还书时间');
            $table->integer('returns')->comment('是否还书');
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
        Schema::drop('borrows');
    }
}
