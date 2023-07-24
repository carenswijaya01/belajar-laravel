<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EnvironmentTest extends TestCase
{
    public function testGetEnv()
    {
        $yt = env('YOUTUBE');
        self::assertEquals('Programmer Zaman Now', $yt);
    }

    public function testDefaultEnv()
    {
        $author = env('AUTHOR', 'Carens');
        self::assertEquals('Carens', $author);
    }
}
