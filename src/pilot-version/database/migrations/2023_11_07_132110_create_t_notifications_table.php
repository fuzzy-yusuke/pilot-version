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
        Schema::create('t_notifications', function (Blueprint $table) {
            $table->foreignUuid('tenant_id')->constrained('m_tenants', 'tenant_id');
            $table->uuid('notification_id');
            $table->string('user_id', 10);
            $table->string('type', 50)->nullable();
            $table->text('content');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
            $table->string('updated_by')->nullable();
            $table->string('update_program')->nullable();
            $table->integer('version')->nullable();

            $table->primary(['tenant_id', 'notification_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_notifications');
    }
};
