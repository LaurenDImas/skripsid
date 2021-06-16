<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkScheduleActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::table('schedule_activities', function (Blueprint $table) {
            
            $table->unsignedBigInteger('new_assignment_id')->index()->nullable();
            $table->foreign('new_assignment_id')->references('id')->on('new_assignments')->onDelete('cascade');
        });
    }
66
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schedule_activities', function (Blueprint $table) {
            $table->dropColumn('new_assignment_id');
        });
    }
}
