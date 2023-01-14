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
        Schema::create("socialmedia", function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("title");
            $table->string("description")->nullable();
            $table->string("url");
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
