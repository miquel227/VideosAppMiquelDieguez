<?php

namespace Tests\Unit;

use App\Models\Serie;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SerieTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function serie_have_videos(): void
    {
        // Arrange
        $serie = Serie::factory()->create();
        $videos = Video::factory()->count(3)->create(['series_id' => $serie->id]);

        // Act
        $result = $serie->videos;

        // Assert
        $this->assertCount(3, $result);
        foreach ($videos as $video) {
            $this->assertTrue($result->contains($video));
        }
    }
}
