<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCompaniesTable
 */
class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->index();
            $table->string('title')->nullable();
            $table->text('address')->nullable();
            $table->text('address_2')->nullable();
            $table->text('address_city')->nullable();
            $table->text('address_region')->nullable();
            $table->text('reg_address')->nullable();
            $table->text('reg_address_2')->nullable();
            $table->text('reg_address_city')->nullable();
            $table->text('reg_address_region')->nullable();
            $table->text('banking_details')->nullable();
            $table->text('comments')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('assigned_by')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
