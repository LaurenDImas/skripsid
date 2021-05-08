<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_by')->index();
            $table->integer('updated_by')->nullable();
            $table->unsignedBigInteger('project_id')->index();
            $table->unsignedBigInteger('application_id')->index();
            $table->date('date');
            $table->text('activity')->nullable();
            $table->text('constraint')->nullable();
            $table->text('note')->nullable();
            $table->time('hour_start')->nullable();
            $table->time('hour_end')->nullable();
            $table->json('file')->nullable();
            
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('application_id')->references('id')->on('applications')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule_activities');
    }
}
