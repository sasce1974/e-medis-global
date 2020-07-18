<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->time('start_time');
            $table->time('end_time');
            $table->date('date');
            $table->integer('therapy_id')->nullable();
            $table->integer('therapist_id')->nullable();
            $table->integer('record_id')->nullable();//will connect to customer record
            $table->boolean('reserved')->default(0);
            $table->text('note')->nullable();
            $table->date('delete_request')->nullable();
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
        Schema::dropIfExists('fields');
    }
}
