<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceEditItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_edit_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attendance_edit_request_id')->constrained('attendance_edit_requests')->onDelete('cascade');
            $table->foreignId('break_id')->nullable()->constrained('breaks')->onDelete('cascade');
            $table->enum('field_name',['clock_in','clock_out','break_start','break_end','remarks']);
            $table->text('before_value')->nullable();
            $table->text('after_value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances_edit_items');
    }
}
