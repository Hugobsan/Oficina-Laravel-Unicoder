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
        Schema::create('livro', function (Blueprint $table) {
            $table->id();
            $table->string('titulo')->index();
            $table->integer('volume');
            $table->integer('edicao');
            $table->integer('paginas');
            $table->char('isbn', 13)->unique();
            $table->string('autor')->index();
            $table->string('genero')->index();
            $table->string('editora');
            $table->integer('quantidade');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livro');
    }
};
