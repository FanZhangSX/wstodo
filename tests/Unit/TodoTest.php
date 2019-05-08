<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Todo;

class TodoTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGetTodos()
    {
        $response = $this->get('api/todos');
        $response->assertStatus(200);
    }
}
