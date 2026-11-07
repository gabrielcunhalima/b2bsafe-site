<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Testes de feature não dependem dos assets compilados; os de navegador usam o build real.
        if (! str_contains(static::class, '\\Browser\\')) {
            $this->withoutVite();
        }
    }
}
