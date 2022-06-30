<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVlnerabilityUsersTokenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('vlnerability_users_token')) {
            return;
        }
        Schema::create('vlnerability_users_token', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->comment('用户id');
            $table->string('user_code')->default('')->comment('用户code');
            $table->string('user_pwd_code')->default('')->comment('公钥加密字符串');
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
        if (!Schema::hasTable('vlnerability_users_token')) {
            return;
        }
        Schema::dropIfExists('vlnerability_users_token');
    }
}
