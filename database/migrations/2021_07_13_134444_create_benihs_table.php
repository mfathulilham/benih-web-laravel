<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBenihsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('benihs', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('gambar');
            $table->string('kategori');
            $table->string('varietas');
            $table->tinyInteger('umur');
            $table->string('potensi');
            $table->string('rekomendasi');
            $table->string('deskripsi')->nullable();
            $table->string('variasi');
            $table->integer('stok');
            $table->double('harga');
            $table->integer('terjual')->default(0);
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('benihs');
    }
}
