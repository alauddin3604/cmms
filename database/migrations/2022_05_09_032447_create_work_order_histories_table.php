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
        Schema::create('work_order_histories', function (Blueprint $table) {
            $table->id();
            $table->string('priority');
            $table->string('maintenance_type');
            $table->string('status');
            $table->dateTime('date_assigned');
            $table->dateTime('date_finished');
            $table->text('remarks');
            $table->string('technician_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_order_histories');
    }
};
