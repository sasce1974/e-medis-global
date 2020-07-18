<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('department_id')->nullable(); // patients will be null here
            $table->unsignedBigInteger('role_id')->default(4); // Unassigned
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->date('birth_date')->nullable();
            $table->text('note')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            // TODO consider using softdelete package that will affect foreign keys related records
            // run: "composer require askedio/laravel-soft-cascade", ref. https://laravel-news.com/cascading-soft-deletes#:~:text=Laravel%20Soft%20Cascade%20is%20a,related%20models%20using%20soft%20deleting.

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
