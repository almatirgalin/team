<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateLeadsTable
 */
class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lead_id')->index();
            $table->string('title')->nullable();
            $table->string('name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('second_name')->nullable();
            $table->string('company_title')->nullable();
            $table->text('address')->nullable();
            $table->text('address_2')->nullable();
            $table->text('address_city')->nullable();
            $table->text('address_region')->nullable();
            $table->string('opportunity')->nullable();
            $table->text('comments')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('assigned_by')->nullable();
            $table->integer('company_id')->nullable();
            $table->integer('contact_id')->nullable();
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
        Schema::dropIfExists('leads');
    }
}
