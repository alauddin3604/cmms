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
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->string('work_order_id');
            $table->string('priority');
            $table->string('maintenance_type');
            $table->string('status');
            $table->timestamps();
            $table->dateTime('date_finished');
            $table->text('remarks');
            $table->foreignId('asset_id')->constrained();
            $table->foreignId('supervisor_id')->constrained();
            $table->foreignId('technician_id')->constrained();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_orders');
    }
};
