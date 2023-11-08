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
        Schema::create('m_cars', function (Blueprint $table) {
            $table->foreignUuid('tenant_id');
            $table->string('car_id', 10)->unique();
            $table->string('car_type')->nullable();
            $table->string('number_plate');
            $table->string('manager')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('department_id');
            $table->timestamps();
            $table->string('updated_by');
            $table->string('update_program');
            $table->integer('version')->nullable();

            $table->primary(['tenant_id', 'car_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_cars');
    }
};
