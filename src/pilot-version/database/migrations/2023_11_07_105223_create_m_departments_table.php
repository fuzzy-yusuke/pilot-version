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
        Schema::create('m_departments', function (Blueprint $table) {
            $table->foreignUuid('tenant_id');
            $table->string('department_id', 10);
            $table->string('department_name');
            $table->string('phone_number', 40);
            $table->string('fax_number', 40)->nullable();
            $table->string('postal_code', 40)->nullable();
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('address3')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('parent_department_id')->nullable();
            $table->timestamps();
            $table->string('updater');
            $table->string('update_program');
            $table->integer('version')->nullable();

            $table->primary(['tenant_id', 'department_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_departments');
    }
};
