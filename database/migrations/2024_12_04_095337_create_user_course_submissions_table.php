<?php

use App\Models\Course;
use App\Models\CourseSubmission;
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
        Schema::create('user_course_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(CourseSubmission::class)->constrained();
            $table->foreignIdFor(Course::class)->constrained();
            // file path
            $table->string('file_path');
            // status
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            // score
            $table->integer('score')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_course_submissions');
    }
};
