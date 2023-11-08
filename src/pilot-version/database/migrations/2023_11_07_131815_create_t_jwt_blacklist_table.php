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
        Schema::create('t_jwt_blacklist', function (Blueprint $table) {
            $table->mediumInteger('id')->generatedAs()->primary();
            $table->string('jti');
            $table->string('token', 1024);
            $table->timestamp('expiry');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_jwt_blacklist');
    }
};
