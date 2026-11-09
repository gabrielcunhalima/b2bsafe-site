<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Primeiro toque da visita (RF-008, RN-008) e evidência de consentimento (RN-011).
     */
    public function up(): void
    {
        Schema::create('origens', function (Blueprint $table) {
            $table->id();
            $table->string('canal', 100);
            $table->string('utm_source')->nullable();
            $table->string('utm_medium')->nullable();
            $table->string('utm_campaign')->nullable();
            $table->string('utm_term')->nullable();
            $table->string('utm_content')->nullable();
            $table->string('gclid')->nullable();
            $table->string('fbclid')->nullable();
            $table->string('referrer', 2048)->nullable();
            $table->string('pagina_entrada', 2048)->nullable();
            $table->timestamp('primeiro_acesso_em');
            $table->timestamps();

            $table->index('canal');
            $table->index('utm_campaign');
        });

        Schema::create('consentimentos', function (Blueprint $table) {
            $table->id();
            $table->uuid('visitante_id');
            $table->string('tipo', 30);
            $table->string('versao_documento', 20);
            $table->json('categorias')->nullable();
            $table->timestamp('created_at')->nullable();

            $table->index('visitante_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consentimentos');
        Schema::dropIfExists('origens');
    }
};
