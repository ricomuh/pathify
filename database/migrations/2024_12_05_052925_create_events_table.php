<?php

use App\Models\EventCategory;
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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(EventCategory::class)->constrained()->cascadeOnDelete();
            $table->string('thumbnail');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('body');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('quota');
            $table->string('location');
            $table->dateTime('registration_start_date');
            $table->dateTime('registration_end_date');
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->json('rundown')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
