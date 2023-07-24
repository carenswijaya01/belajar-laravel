<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigurationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $firstName = config('contoh.author.first');
        $lastName = config('contoh.author.last');

        self::assertEquals('Carens', $firstName);
        self::assertEquals('Wijaya', $lastName);
    }
}
