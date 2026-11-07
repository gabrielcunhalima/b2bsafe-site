#!/bin/sh
# Hook commit-msg (Lefthook): exige Conventional Commits, com o tipo em inglês e a descrição em português.
# Uso: sh scripts/verificar-mensagem-commit.sh <arquivo-da-mensagem>

primeira_linha=$(head -n 1 "$1")

if printf '%s\n' "$primeira_linha" | grep -Eq '^(feat|fix|chore|docs|refactor|test|ci|perf|build|style|revert)(\([a-z0-9-]+\))?!?: .+'; then
    exit 0
fi

echo "Mensagem fora do padrão Conventional Commits: \"$primeira_linha\""
echo "Exemplo: feat: adiciona formulário de lead"
exit 1
