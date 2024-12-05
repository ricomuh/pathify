<?php

use App\Models\User;
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
        Schema::create('mentor_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained('users')->cascadeOnDelete();
            $table->string('profession')->nullable();
            $table->string('profession_at')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentor_details');
    }
};
