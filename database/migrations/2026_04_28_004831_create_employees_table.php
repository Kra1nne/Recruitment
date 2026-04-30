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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')
                ->constrained('departments')
                ->restrictOnDelete();
            $table->foreignId('person_id')
                ->unique()
                ->constrained('persons')
                ->restrictOnDelete();
            $table->string('employee_id');
            $table->date('start_date');
             $table->string('position');
            $table->integer('salary');
            $table->string('work_status');
            $table->string('work_arrangement');
            $table->date('end_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
