<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('endereco_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id'); 
            $table->string('cep', 9);
            $table->string('uf', 2);
            $table->string('cidade', 255);
            $table->string('bairro', 255)->nullable();
            $table->string('logradouro', 255);
            $table->string('numero', 10);
            $table->timestamps();

            $table->foreign('usuario_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enderecos_user');
    }
};
