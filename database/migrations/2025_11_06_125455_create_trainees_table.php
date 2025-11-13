<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trainees', function (Blueprint $table) {
            $table->id('traineeId');
            $table->string('tFirstName', 50);
            $table->string('tLastName', 50);
            $table->enum('tGender', ['Male', 'Female']);
            $table->date('DOB');
            $table->string('ParentNationalId', 20);
            $table->string('tradeCode', 10);
            $table->enum('Level', ['Level 1', 'Level 2', 'Level 3', 'Level 4', 'Level 5']);
            $table->timestamps();

            $table->foreign('ParentNationalId')
                  ->references('ParentNationalId')
                  ->on('parents')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('tradeCode')
                  ->references('tradeCode')
                  ->on('trades')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trainees');
    }
};
