<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parents', function (Blueprint $table) {
            $table->string('ParentNationalId', 20)->primary();
            $table->string('pFirstName', 50);
            $table->string('pLastName', 50);
            $table->enum('pGender', ['Male', 'Female']);
            $table->string('PhoneNumber', 15);
            $table->string('District', 50);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parents');
    }
};