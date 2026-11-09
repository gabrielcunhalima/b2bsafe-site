<?php

/*
 * Preenche N8N_ENCRYPTION_KEY no .env se estiver vazia (usado pelo `composer setup`).
 * A chave cifra as credenciais guardadas no n8n: depois de gerada, não deve mudar.
 */

$arquivo = __DIR__.'/../.env';
$conteudo = (string) file_get_contents($arquivo);

if (preg_match('/^N8N_ENCRYPTION_KEY=\S+/m', $conteudo)) {
    exit(0);
}

$chave = bin2hex(random_bytes(24));
$conteudo = preg_match('/^N8N_ENCRYPTION_KEY=/m', $conteudo)
    ? preg_replace('/^N8N_ENCRYPTION_KEY=.*$/m', "N8N_ENCRYPTION_KEY={$chave}", $conteudo)
    : $conteudo.PHP_EOL."N8N_ENCRYPTION_KEY={$chave}".PHP_EOL;

file_put_contents($arquivo, $conteudo);
echo 'N8N_ENCRYPTION_KEY gerada no .env'.PHP_EOL;
