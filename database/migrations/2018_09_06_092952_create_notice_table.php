<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',50)->default('');
            $table->string('content',1000)->default('');
            $table->timestamps();
        });

        Schema::create('users_notices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('users_id')->default(0);
            $table->integer('notices_id')->default(0);
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
        Schema::dropIfExists('notices');
        Schema::dropIfExists('users_notices');
    }
}
