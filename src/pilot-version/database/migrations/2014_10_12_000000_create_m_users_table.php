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
        Schema::create('m_users', function (Blueprint $table) {
            $table->foreignUuid('tenant_id');
            $table->string('user_id', 10);
            $table->string('user_name');
            $table->string('email')->unique();
            $table->string('password_hash');
            $table->rememberToken();
            $table->string('department_id', 10);
            $table->boolean('role')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->timestamps();
            $table->string('updated_by');
            $table->string('update_program');
            $table->integer('version')->nullable();

            $table->primary(['tenant_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_users');
    }
};
