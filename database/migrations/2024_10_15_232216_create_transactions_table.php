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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->string('transaction_id');
            $table->string('transaction_type');
            $table->string('transaction');
            $table->string('credit');
            $table->string('debit');
            $table->tinyInteger('status')->default(0)->comment('0=pending, 1=approved');
            $table->timestamps(); // Creates `created_at` and `updated_at` columns

            // Optional: Define foreign key constraint if you have a users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
