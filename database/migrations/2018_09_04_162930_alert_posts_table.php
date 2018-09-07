<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlertPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('posts',function(Blueprint $table){
            $table->tinyInteger('status')->default(0); // ���� 0δ֪ 1ͨ�� -1ɾ��
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('posts',function(Blueprint $table){
            $table->dropColumn('status'); 
        });
    }
}
