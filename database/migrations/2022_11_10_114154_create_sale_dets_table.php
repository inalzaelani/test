<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleDetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_dets', function (Blueprint $table) {
            $table->id();
            $table->integer("sales_id");
            $table->integer("barang_id");
            $table->decimal("harga_bandrol", 10, 2);
            $table->integer("qty");
            $table->decimal("diskon_pct", 10, 2);
            $table->decimal("diskon_nilai", 10, 2);
            $table->decimal("harga_diskon", 10, 2);
            $table->decimal("ongkir", 10, 2);
            $table->decimal("total", 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_dets');
    }
}
