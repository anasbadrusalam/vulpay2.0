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
        Schema::create('inbox_rules', function (Blueprint $table) {
            $table->id();
            $table->string('sender')->nullable();
            $table->string('keyword')->nullable();
            $table->string('regex_number')->nullable();
            $table->string('regex_amount')->nullable();
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
        Schema::dropIfExists('inbox_rules');
    }
};
