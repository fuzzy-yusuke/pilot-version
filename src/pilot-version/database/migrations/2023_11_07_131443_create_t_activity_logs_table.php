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
        Schema::create('t_activity_logs', function (Blueprint $table) {
            $table->mediumInteger('id')->generatedAs()->primary();
            $table->foreignUuid('tenant_id');
            $table->string('user_id', 10);
            $table->text('activity_description');
            $table->timestampTz('timestamp')->default(now());
            $table->jsonb('json')->nullable();
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
        Schema::dropIfExists('t_activity_logs');
    }
};
