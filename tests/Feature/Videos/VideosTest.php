<?php

namespace Tests\Feature\Videos;

use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class VideosTest extends TestCase
{
    use RefreshDatabase;

    // ─── Tests del Sprint 2: show ─────────────────────────────────────────────

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

    public function test_users_cannot_view_not_existing_videos(): void
    {
        // Arrange — no video creat

        // Act
        $response = $this->get(route('videos.show', ['video' => 999]));

        // Assert
        $response->assertStatus(404);
    }

    // ─── Tests del Sprint 4: index públic ────────────────────────────────────

    #[Test]
    public function not_logged_users_can_see_default_videos_page(): void
    {
        // Arrange
        Video::factory()->count(3)->create();

        // Act
        $response = $this->get(route('videos.index'));

        // Assert
        $response->assertStatus(200);
    }

    #[Test]
    public function user_with_permissions_can_see_default_videos_page(): void
    {
        // Arrange
        create_permissions();
        $user = create_video_manager_user();
        Video::factory()->count(3)->create();

        // Act
        $response = $this->actingAs($user)->get(route('videos.index'));

        // Assert
        $response->assertStatus(200);
    }

    #[Test]
    public function user_without_permissions_can_see_default_videos_page(): void
    {
        // Arrange
        create_permissions();
        $user = create_regular_user();
        Video::factory()->count(3)->create();

        // Act
        $response = $this->actingAs($user)->get(route('videos.index'));

        // Assert
        $response->assertStatus(200);
    }
}
