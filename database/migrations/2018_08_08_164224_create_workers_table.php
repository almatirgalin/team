<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateWorkersTable
 */
class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('worker_id')->unique();
            $table->string('name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('second_name')->nullable();
            $table->timestamp('birth_date')->nullable();
            $table->text('photo')->nullable();
            $table->text('position')->nullable();
            $table->text('skills')->nullable();
            $table->text('interests')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('skype')->nullable();
            $table->boolean('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workers');
    }
}
