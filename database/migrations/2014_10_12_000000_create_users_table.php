<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('telp')->unique();
            $table->string('password');
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            // $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('telp_verified_at')->nullable();
            $table->date('lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->string('prov')->nullable();
            $table->string('kab')->nullable();
            $table->string('kec')->nullable();
            $table->tinyInteger('role');
            $table->string('otp');
            $table->boolean('confirmed')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
