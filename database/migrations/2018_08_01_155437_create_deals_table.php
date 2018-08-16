<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateDealsTable
 */
class CreateDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('deal_id')->index();
            $table->string('title')->nullable();
            $table->string('stage')->nullable();
            $table->integer('opportunity')->nullable();
            $table->string('closed')->nullable();
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
        Schema::dropIfExists('deals');
    }
}
