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
        Schema::create('m_tenant_control', function (Blueprint $table) {
            $table->foreignUuid('tenant_id');
            $table->string('tenant_name1');
            $table->string('tenant_name2')->nullable();
            $table->date('processing_date');
            $table->time('processing_time');
            $table->string('phone_number', 40);
            $table->string('fax_number', 40)->nullable();
            $table->string('postal_code', 40)->nullable();
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('address3')->nullable();
            $table->string('Invoice_Issuer')->nullable();
            $table->timestamps();
            $table->string('updated_by')->nullable();
            $table->string('update_program')->nullable();
            $table->integer('version')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_tenant_control');
    }
};
