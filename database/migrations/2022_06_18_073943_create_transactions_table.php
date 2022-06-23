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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('provider');
            $table->string('sender');
            $table->float('rate', 8, 2);
            $table->string('code');
            $table->string('terminal');
            $table->string('receiver');
            $table->unsignedBigInteger('amount')->nullable();
            $table->unsignedBigInteger('balance')->nullable();
            $table->string('status')->default('menunggu');
            $table->string('note')->nullable();
            $table->timestamp('expired_at')->nullable();
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
        Schema::dropIfExists('transactions');
    }
};
