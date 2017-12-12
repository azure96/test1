<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_user', function (Blueprint $table) {
            $table->increments('book_id');
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
        Schema::drop('book_user');
    }
}
