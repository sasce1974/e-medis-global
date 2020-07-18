<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); //User id has to be manually inserted
            $table->unsignedBigInteger('department_id');
            $table->string('role')->default('Unassigned');
            $table->date('employed_at')->useCurrent();
            $table->date('employed_to')->nullable();
            $table->integer('admin_level')->nullable(); //level 1 - clinic admin, level 2 - department admin
            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('employees');
    }
}
