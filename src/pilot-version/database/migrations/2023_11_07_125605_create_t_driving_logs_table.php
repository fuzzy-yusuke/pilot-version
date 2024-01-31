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
        Schema::create('t_driving_logs', function (Blueprint $table) {
            $table->foreignUuid('tenant_id')->constrained('m_tenants', 'tenant_id');
            $table->uuid('log_id');
            $table->string('user_id', 10);
            $table->string('car_id', 10);
            $table->date('driving_date')->nullable();
            $table->string('destination')->nullable();
            $table->timestamp('departure_time')->nullable();
            $table->timestamp('arrival_time')->nullable();
            $table->integer('start_mileage')->nullable();
            $table->integer('end_mileage')->nullable();
            $table->decimal('fuel')->nullable();
            $table->boolean('license_confirmation')->nullable();
            $table->string('license_confirmer_id', 10)->nullable();
            $table->boolean('pre_alcohol_check')->nullable();
            $table->string('pre_alcohol_checker_id', 10)->nullable();
            $table->boolean('post_alcohol_check')->nullable();
            $table->string('post_alcohol_checker_id', 10)->nullable();
            $table->string('return_driver_id', 10)->nullable();
            $table->timestamps();
            $table->string('updated_by');
            $table->string('update_program');
            $table->integer('version')->nullable();

            $table->primary(['tenant_id', 'log_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_driving_logs');
    }
};
