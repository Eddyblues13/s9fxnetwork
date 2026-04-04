<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // BIGINT UNSIGNED NOT NULL
            $table->string('transaction_id', 255); // VARCHAR(255) NOT NULL
            $table->integer('amount'); // INT(11) NOT NULL
            $table->string('wallet_id', 255)->nullable(); // VARCHAR(255) NULL
            $table->string('image', 250)->nullable(); // VARCHAR(250) NULL
            $table->string('payment_method', 255); // VARCHAR(255) NOT NULL
            $table->tinyInteger('status')->default(0)->comment('0=pending, 1=approved'); // TINYINT(4) NOT NULL DEFAULT 0
            $table->timestamps(); // Adds 'created_at' and 'updated_at' columns

            // Foreign key constraint assuming a 'users' table exists
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposits');
    }
};
