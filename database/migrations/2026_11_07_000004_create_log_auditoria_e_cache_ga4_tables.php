<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Log de ações sensíveis (RF-030) e cache dos relatórios do GA4 (RF-022).
     */
    public function up(): void
    {
        Schema::create('log_auditoria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->nullable()->constrained('usuarios')->nullOnDelete();
            $table->string('acao', 50);
            $table->string('entidade', 50)->nullable();
            $table->string('entidade_id', 50)->nullable();
            $table->json('detalhes')->nullable();
            $table->string('ip', 45)->nullable();
            $table->timestamp('created_at')->nullable();

            $table->index(['acao', 'created_at']);
        });

        Schema::create('cache_ga4', function (Blueprint $table) {
            $table->id();
            $table->string('relatorio', 50);
            $table->string('periodo', 30);
            $table->json('dados');
            $table->timestamp('atualizado_em');

            $table->unique(['relatorio', 'periodo']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cache_ga4');
        Schema::dropIfExists('log_auditoria');
    }
};
