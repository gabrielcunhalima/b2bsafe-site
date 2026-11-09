<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/*
|--------------------------------------------------------------------------
| Configuração do Pest
|--------------------------------------------------------------------------
| Unit: classes puras, sem framework nem banco.
| Feature: requisições HTTP e banco (MariaDB, base b2bsafe_testes).
| Browser: E2E no navegador com Playwright; exige `npm run build` antes.
|
| Convenção: todo teste de regra de negócio cita a RN no nome ou no describe.
*/

pest()->extend(TestCase::class)
    ->use(RefreshDatabase::class)
    ->in('Feature', 'Browser');
