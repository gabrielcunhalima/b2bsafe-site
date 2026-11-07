<?php

/*
 * Hook PostToolUse do Claude Code: formata com o Pint o arquivo PHP que acabou de ser editado.
 * Recebe o JSON do evento na entrada padrão (tool_input.file_path). Nunca bloqueia a edição.
 */

$evento = json_decode((string) stream_get_contents(STDIN), true);
$arquivo = $evento['tool_input']['file_path'] ?? null;

if (! is_string($arquivo) || ! str_ends_with($arquivo, '.php') || ! is_file($arquivo)) {
    exit(0);
}

$raiz = getenv('CLAUDE_PROJECT_DIR') ?: dirname(__DIR__, 2);
$pint = $raiz.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'bin'.DIRECTORY_SEPARATOR.'pint';

if (! is_file($pint)) {
    exit(0);
}

passthru(escapeshellarg(PHP_BINARY).' '.escapeshellarg($pint).' --quiet '.escapeshellarg($arquivo));
exit(0);
