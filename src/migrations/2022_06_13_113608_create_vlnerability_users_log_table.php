<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVlnerabilityUsersLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('vlnerability_users_log')) {
            return;
        }
        Schema::create('vlnerability_users_log', function (Blueprint $table) {
            $table->id();
            $table->string('user_code')->default('')->comment('用户code');
            $table->string('onclick_type')->default('')->comment('触发事件');
            $table->string('in_url', 500)->default('')->comment('进入连接');
            $table->string('out_url', 500)->default('')->comment('跳出连接');
            $table->timestamp('in_time_at')->nullable()->comment('进入时间');
            $table->timestamp('out_time_at')->nullable()->comment('跳出时间');
            $table->integer('times')->default(0)->comment('浏览时长');
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
        if (!Schema::hasTable('vlnerability_users_log')) {
            return;
        }
        Schema::dropIfExists('vlnerability_users_log');
    }
}
