<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //create the members table
        Schema::create('members', function (Blueprint $table) {
            $table->id(); // primary key column, auto incrementing integer
            $table->string('name');
            $table->string('email')->unique();
            $table->string('profession');
            $table->string('company')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();// automatically managed created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
};
