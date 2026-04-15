<?php

namespace Tests\Feature\Series;

use App\Models\Serie;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SeriesTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function users_can_see_series_index(): void
    {
        // Arrange
        create_permissions();
        $user  = create_regular_user();
        $serie = Serie::factory()->create();

        // Act
        $response = $this->actingAs($user)->get(route('series.index'));

        // Assert
        $response->assertStatus(200);
        $response->assertSee($serie->title);
    }

    #[Test]
    public function users_can_see_serie_show(): void
    {
        // Arrange
        create_permissions();
        $user  = create_regular_user();
        $serie = Serie::factory()->create();

        // Act
        $response = $this->actingAs($user)->get(route('series.show', $serie));

        // Assert
        $response->assertStatus(200);
        $response->assertSee($serie->title);
    }

    #[Test]
    public function guests_cannot_see_series(): void
    {
        // Arrange
        $serie = Serie::factory()->create();

        // Act
        $response = $this->get(route('series.index'));

        // Assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }
}
