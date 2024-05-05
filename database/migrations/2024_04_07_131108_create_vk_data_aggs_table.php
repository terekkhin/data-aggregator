<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vk_data_aggs', function (Blueprint $table) {
            $table->id();
            $table->string('group_name');
            $table->string('group_id');
            $table->date('date');
            $table->unsignedInteger('cnt_posts');
            $table->unsignedInteger('cnt_likes');
            $table->unsignedInteger('cnt_comments');
            $table->unsignedInteger('cnt_reposts');
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
        Schema::dropIfExists('vk_data_aggs');
    }
};
