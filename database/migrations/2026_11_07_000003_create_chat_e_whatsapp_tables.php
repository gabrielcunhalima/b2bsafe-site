<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Conversas do assistente virtual, mensagens e cliques no WhatsApp
     * (RF-005, RF-013 a RF-017, RF-028, RN-010, RN-013).
     */
    public function up(): void
    {
        Schema::create('conversas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('lead_id')->nullable()->constrained('leads')->nullOnDelete();
            $table->foreignId('origem_id')->nullable()->constrained('origens')->nullOnDelete();
            $table->foreignId('consentimento_id')->nullable()->constrained('consentimentos')->nullOnDelete();
            $table->string('pagina_inicial', 2048)->nullable();
            $table->boolean('transbordo')->default(false);
            $table->timestamp('ultima_mensagem_em')->nullable();
            $table->timestamp('anonimizado_em')->nullable();
            $table->timestamps();
        });

        Schema::create('mensagens', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('conversa_id')->constrained('conversas')->cascadeOnDelete();
            $table->string('papel', 20);
            $table->text('conteudo');
            $table->string('topico', 100)->nullable();
            $table->boolean('sem_resposta')->default(false);
            $table->timestamp('resolvida_em')->nullable();
            $table->string('diagnostico', 500)->nullable();
            $table->timestamp('created_at')->nullable();

            $table->index(['sem_resposta', 'resolvida_em']);
        });

        Schema::create('cliques_whatsapp', function (Blueprint $table) {
            $table->id();
            $table->string('numero', 20);
            $table->string('pagina', 2048)->nullable();
            $table->string('servico', 50)->nullable();
            $table->foreignId('origem_id')->nullable()->constrained('origens')->nullOnDelete();
            $table->foreignUuid('conversa_id')->nullable()->constrained('conversas')->nullOnDelete();
            $table->foreignId('lead_id')->nullable()->constrained('leads')->nullOnDelete();
            $table->timestamp('created_at')->nullable();

            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cliques_whatsapp');
        Schema::dropIfExists('mensagens');
        Schema::dropIfExists('conversas');
    }
};
