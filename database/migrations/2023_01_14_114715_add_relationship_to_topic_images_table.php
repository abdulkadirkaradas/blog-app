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
        Schema::table("topic_images", function (Blueprint $table) {
            $table->uuid("topic_id");
            $table->foreign("topic_id", "topic_id_fk_1148567")->references("id")->on("topics");
        });
    }
};
