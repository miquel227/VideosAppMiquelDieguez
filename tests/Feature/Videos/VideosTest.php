<?php

namespace Tests\Feature\Videos;

use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideosTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_users_can_view_videos(): void
    {
        // Arrange
        $video = Video::factory()->create([
            'title'        => 'Video de prova',
            'description'  => 'Descripció del video de prova',
            'url'          => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'published_at' => now(),
        ]);

        // Act
        $response = $this->get(route('videos.show', $video));

        // Assert
        $response->assertStatus(200);
        $response->assertSee($video->title);
    }

    /** @test */
    public function test_users_cannot_view_not_existing_videos(): void
    {
        // Arrange — no video creat

        // Act
        $response = $this->get(route('videos.show', ['video' => 999]));

        // Assert
        $response->assertStatus(404);
    }
}
