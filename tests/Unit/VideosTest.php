<?php

namespace Tests\Unit;

use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideosTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_can_get_formatted_published_at_date(): void
    {
        // Arrange
        $video = Video::factory()->create([
            'published_at' => '2025-01-13 10:00:00',
        ]);

        // Act
        $formatted = $video->formatted_published_at;

        // Assert
        $this->assertEquals('13 de gener de 2025', $formatted);
    }

    /** @test */
    public function test_can_get_formatted_published_at_date_when_not_published(): void
    {
        // Arrange
        $video = Video::factory()->create([
            'published_at' => null,
        ]);

        // Act
        $formatted = $video->formatted_published_at;

        // Assert
        $this->assertNull($formatted);
    }
}
