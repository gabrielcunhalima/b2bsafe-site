<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Leads e o que acontece com eles: interações, histórico de status e anotações
     * (RF-006, RF-015, RF-024, RF-025, RN-003 a RN-007).
     */
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->nullable();
            $table->string('whatsapp', 20)->nullable();
            $table->string('email')->nullable();
            $table->string('servico', 50);
            $table->text('mensagem')->nullable();
            $table->string('canal_captacao', 20);
            $table->string('status', 20)->default('novo');
            $table->string('motivo_perda', 30)->nullable();
            $table->string('motivo_perda_detalhe', 500)->nullable();
            $table->timestamp('primeiro_contato_em')->nullable();
            $table->timestamp('ultima_interacao_em')->nullable();
            $table->timestamp('voltou_contato_em')->nullable();
            $table->foreignId('lead_anterior_id')->nullable()->constrained('leads')->nullOnDelete();
            $table->foreignId('origem_id')->nullable()->constrained('origens')->nullOnDelete();
            $table->foreignId('consentimento_id')->nullable()->constrained('consentimentos')->nullOnDelete();
            $table->timestamp('anonimizado_em')->nullable();
            $table->timestamps();

            // Deduplicação (RN-003) e relatórios (RN-007)
            $table->index('whatsapp');
            $table->index('email');
            $table->index(['created_at', 'status']);
        });

        Schema::create('interacoes_lead', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->constrained('leads')->cascadeOnDelete();
            $table->string('tipo', 20);
            $table->text('conteudo')->nullable();
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('historico_status', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->constrained('leads')->cascadeOnDelete();
            $table->foreignId('usuario_id')->nullable()->constrained('usuarios')->nullOnDelete();
            $table->string('status_anterior', 20)->nullable();
            $table->string('status_novo', 20);
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('anotacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->constrained('leads')->cascadeOnDelete();
            $table->foreignId('usuario_id')->nullable()->constrained('usuarios')->nullOnDelete();
            $table->text('texto');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anotacoes');
        Schema::dropIfExists('historico_status');
        Schema::dropIfExists('interacoes_lead');
        Schema::dropIfExists('leads');
    }
};
