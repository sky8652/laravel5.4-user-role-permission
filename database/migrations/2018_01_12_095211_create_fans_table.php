<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fans', function (Blueprint $table) {
            //表备注
            $table->comment("微信粉丝表");
            //字段信息
            $table->increments('id');
            $table->integer('subscribe')->nullable()->comment('是否关注');
            $table->string('openid');
            $table->string('nickname')->nullable()->comment('微信昵称');
            $table->integer('sex')->nullable()->comment('性别');
            $table->string('country')->nullable()->comment('国家');
            $table->string('province')->nullable()->comment('省份');
            $table->string('city')->nullable()->comment('城市');
            $table->string('headimgurl')->nullable()->comment('微信头像');
            $table->string('subscribe_time')->nullable()->comment('关注时间');
            $table->string('remark')->nullable()->comment('备注');
            $table->integer('groupid')->nullable()->comment('组ID');
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
        Schema::dropIfExists('fans');
    }
}
