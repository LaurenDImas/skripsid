<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewAssignmentEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_assignment_employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_by')->index();
            $table->unsignedBigInteger('new_assignment_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->integer('updated_by')->nullable();
           
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('new_assignment_id')->references('id')->on('new_assignments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('new_assignment_employees');
    }
}
