<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('on_post');
            $table->unsignedBigInteger('on_classroom');
            $table->unsignedBigInteger('from_user');
            $table->foreign('on_post')
                ->references('id')->on('posts')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('on_classroom')
                ->references('id')->on('posts')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('from_user')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->text('grade')->default('0/0');
            $table->text('remark')->nullable();
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
        Schema::dropIfExists('submissions');
    }
}
