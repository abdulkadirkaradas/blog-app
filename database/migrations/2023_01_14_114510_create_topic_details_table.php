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
        Schema::create("topic_details", function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->text("detail");
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
