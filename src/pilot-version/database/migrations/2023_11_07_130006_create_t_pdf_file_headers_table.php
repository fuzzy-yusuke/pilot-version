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
        Schema::create('t_pdf_file_headers', function (Blueprint $table) {
            $table->foreignUuid('tenant_id')->nullable()->constrained('m_tenants', 'tenant_id');
            $table->uuid('pdf_id');
            $table->string('file_name');
            $table->timestamp('uploaded_at');
            $table->jsonb('email_data');
            $table->text('text_data');
            $table->string('remarks1')->nullable();
            $table->string('remarks2')->nullable();
            $table->boolean('logical_deletion')->default(false);
            $table->timestamps();
            $table->string('updated_by');
            $table->string('update_program');
            $table->integer('version')->nullable();

            $table->primary(['tenant_id', 'pdf_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_pdf_file_headers');
    }
};
