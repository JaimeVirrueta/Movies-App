<?php

namespace Tests\Feature;

use App\Models\Turn;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class TurnTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_turns()
    {
        $this->login();

        factory(Turn::class, 10)->create();

        $response = $this->get('/api/v1/turn');

        $response->assertStatus(200);
        $response->assertJsonCount(10, 'data');
    }

    /** @test */
    public function it_can_create_a_turn()
    {
        $this->login();

        $data = [
            'turn_name' => '08:30',
            'is_active' => true,
        ];

        $response = $this->post('/api/v1/turn', $data);

        $response->assertStatus(201);
        $this->assertDatabaseCount('turns', 1);
    }
}
