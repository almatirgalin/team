<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateContactsTable
 */
class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contact_id')->index();
            $table->string('name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('second_name')->nullable();
            $table->string('birth_date')->nullable();
            $table->text('address')->nullable();
            $table->text('address_2')->nullable();
            $table->text('address_city')->nullable();
            $table->text('address_region')->nullable();
            $table->text('comments')->nullable();
            $table->text('post')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('assigned_by')->nullable();
            $table->integer('company_id')->nullable();
            $table->timestamp('date_create')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
