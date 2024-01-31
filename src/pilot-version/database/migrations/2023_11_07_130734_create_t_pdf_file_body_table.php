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
        Schema::create('t_pdf_file_body', function (Blueprint $table) {
            $table->foreignUuid('tenant_id')->nullable()->constrained('m_tenants', 'tenant_id');
            $table->uuid('pdf_id')->nullable();
            $table->integer('body_id')->nullable();
            $table->string('key')->nullable();
            $table->text('value')->nullable();
            $table->text('remarks1')->nullable();
            $table->text('remarks2')->nullable();
            $table->timestamps();
            $table->string('updated_by');
            $table->string('update_program');
            $table->integer('version')->nullable();

            $table->primary(['tenant_id', 'pdf_id', 'body_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_pdf_file_body');
    }
};
