<?php

namespace Tests\Feature;

use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MovieTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_movies()
    {
        $this->login();

        factory(Movie::class, 50)->create();

        $response = $this->get('/api/v1/movie');

        $response->assertStatus(200);
        $response->assertJsonCount(10, 'data');
    }

    /** @test */
    public function it_can_create_a_movie()
    {
        $this->login();
        Storage::fake('movie_files');

        $data = [
            'name' => 'Avengers 20',
            'published_at' => '2019-08-06',
            'image' => UploadedFile::fake()->image('image.jpg'),
            'is_active' => true,
        ];

        $response = $this->json('POST', '/api/v1/movie', $data);

        Storage::disk('movie_files')->assertExists('1.jpg');

        $response->assertStatus(201);
        $this->assertDatabaseCount('movies', 1);
    }
}
