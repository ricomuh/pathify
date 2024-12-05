<?php

use App\Models\CourseStatus;
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
        Schema::create('courses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(User::class, 'mentor_id')->constrained();
            $table->string('thumbnail')->nullable();
            $table->foreignIdFor(CourseStatus::class, 'status_id')->constrained();
            $table->string('title');
            $table->string('slug')->unique();
            $table->integer('level')->default(1);
            $table->text('description');
            $table->text('body');
            $table->json('requirements')->nullable();
            // recommended people categories
            // $table->json('recommended')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
