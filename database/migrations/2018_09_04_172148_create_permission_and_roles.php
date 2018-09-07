<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionAndRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //��ɫ��
        Schema::create('admin_roles',function(Blueprint $table){
            $table->increments('id');
            $table->string('name',30)->default('');
            $table->string('description',100)->default('');
            $table->timestamps();
        });
        //Ȩ�ޱ�
        Schema::create('admin_permissions',function(Blueprint $table){
            $table->increments('id');
            $table->string('name',30)->default('');
            $table->string('description',100)->default('');
            $table->timestamps();
        });
        //Ȩ�޽�ɫ
        Schema::create('admin_permissions_role',function(Blueprint $table){
            $table->increments('id');
            $table->integer('role_id');
            $table->integer('permisstion_id');
            $table->timestamps();
        });
        //�û���ɫ��
        Schema::create('admin_role_user',function(Blueprint $table){
            $table->increments('id');
            $table->integer('role_id');
            $table->integer('user_id');
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
        //
        Schema::drop('admin_roles');
        Schema::drop('admin_permissions');
        Schema::drop('admin_permissions_role');
        Schema::drop('admin_role_user');
    }
}
