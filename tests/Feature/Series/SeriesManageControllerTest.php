<?php

namespace Tests\Feature\Series;

use App\Models\Serie;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SeriesManageControllerTest extends TestCase
{
    use RefreshDatabase;

    // ─── Accés a la gestió ───────────────────────────────────────────────────

    #[Test]
    public function user_with_permissions_can_manage_series(): void
    {
        // Arrange
        create_permissions();
        $user = $this->loginAsVideoManager();

        // Act
        $response = $this->actingAs($user)->get(route('series.manage'));

        // Assert
        $response->assertStatus(200);
    }

    #[Test]
    public function regular_users_cannot_manage_series(): void
    {
        // Arrange
        create_permissions();
        $user = $this->loginAsRegularUser();

        // Act
        $response = $this->actingAs($user)->get(route('series.manage'));

        // Assert
        $response->assertStatus(403);
    }

    #[Test]
    public function guest_users_cannot_manage_series(): void
    {
        // Arrange
        create_permissions();

        // Act
        $response = $this->get(route('series.manage'));

        // Assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    #[Test]
    public function videomanagers_can_manage_series(): void
    {
        // Arrange
        create_permissions();
        $user = $this->loginAsVideoManager();

        // Act
        $response = $this->actingAs($user)->get(route('series.manage'));

        // Assert
        $response->assertStatus(200);
    }

    #[Test]
    public function superadmins_can_manage_series(): void
    {
        // Arrange
        create_permissions();
        $user = $this->loginAsSuperAdmin();

        // Act
        $response = $this->actingAs($user)->get(route('series.manage'));

        // Assert
        $response->assertStatus(200);
    }

    // ─── CREATE ──────────────────────────────────────────────────────────────

    #[Test]
    public function user_with_permissions_can_see_add_series(): void
    {
        // Arrange
        create_permissions();
        $user = $this->loginAsVideoManager();

        // Act
        $response = $this->actingAs($user)->get(route('series.manage.create'));

        // Assert
        $response->assertStatus(200);
    }

    #[Test]
    public function user_without_series_manage_create_cannot_see_add_series(): void
    {
        // Arrange
        create_permissions();
        $user = $this->loginAsRegularUser();

        // Act
        $response = $this->actingAs($user)->get(route('series.manage.create'));

        // Assert
        $response->assertStatus(403);
    }

    #[Test]
    public function user_with_permissions_can_store_series(): void
    {
        // Arrange
        create_permissions();
        $user = $this->loginAsVideoManager();

        // Act
        $response = $this->actingAs($user)->post(route('series.manage.store'), [
            'title'     => 'Nova sèrie de prova',
            'user_name' => 'Video Manager',
        ]);

        // Assert
        $response->assertStatus(302);
        $response->assertRedirect(route('series.manage'));
    }

    #[Test]
    public function user_without_permissions_cannot_store_series(): void
    {
        // Arrange
        create_permissions();
        $user = $this->loginAsRegularUser();

        // Act
        $response = $this->actingAs($user)->post(route('series.manage.store'), [
            'title'     => 'Nova sèrie de prova',
            'user_name' => 'Regular User',
        ]);

        // Assert
        $response->assertStatus(403);
    }

    // ─── EDIT / UPDATE ───────────────────────────────────────────────────────

    #[Test]
    public function user_with_permissions_can_see_edit_series(): void
    {
        // Arrange
        create_permissions();
        $serie = Serie::factory()->create();
        $user  = $this->loginAsVideoManager();

        // Act
        $response = $this->actingAs($user)->get(route('series.manage.edit', $serie));

        // Assert
        $response->assertStatus(200);
        $response->assertSee($serie->title);
    }

    #[Test]
    public function user_without_permissions_cannot_see_edit_series(): void
    {
        // Arrange
        create_permissions();
        $serie = Serie::factory()->create();
        $user  = $this->loginAsRegularUser();

        // Act
        $response = $this->actingAs($user)->get(route('series.manage.edit', $serie));

        // Assert
        $response->assertStatus(403);
    }

    #[Test]
    public function user_with_permissions_can_update_series(): void
    {
        // Arrange
        create_permissions();
        $serie = Serie::factory()->create();
        $user  = $this->loginAsVideoManager();

        // Act
        $response = $this->actingAs($user)->put(route('series.manage.update', $serie), [
            'title'     => 'Títol actualitzat',
            'user_name' => $serie->user_name,
        ]);

        // Assert
        $response->assertStatus(302);
        $response->assertRedirect(route('series.manage'));
    }

    #[Test]
    public function user_without_permissions_cannot_update_series(): void
    {
        // Arrange
        create_permissions();
        $serie = Serie::factory()->create();
        $user  = $this->loginAsRegularUser();

        // Act
        $response = $this->actingAs($user)->put(route('series.manage.update', $serie), [
            'title'     => 'Títol actualitzat',
            'user_name' => $serie->user_name,
        ]);

        // Assert
        $response->assertStatus(403);
    }

    // ─── DELETE / DESTROY ────────────────────────────────────────────────────

    #[Test]
    public function user_with_permissions_can_destroy_series(): void
    {
        // Arrange
        create_permissions();
        $serie = Serie::factory()->create();
        $user  = $this->loginAsVideoManager();

        // Act
        $response = $this->actingAs($user)->delete(route('series.manage.destroy', $serie));

        // Assert
        $response->assertStatus(302);
        $response->assertRedirect(route('series.manage'));
    }

    #[Test]
    public function user_without_permissions_cannot_destroy_series(): void
    {
        // Arrange
        create_permissions();
        $serie = Serie::factory()->create();
        $user  = $this->loginAsRegularUser();

        // Act
        $response = $this->actingAs($user)->delete(route('series.manage.destroy', $serie));

        // Assert
        $response->assertStatus(403);
    }

    // ─── Helpers privats ─────────────────────────────────────────────────────

    private function loginAsVideoManager(): User
    {
        return create_video_manager_user();
    }

    private function loginAsSuperAdmin(): User
    {
        return create_superadmin_user();
    }

    private function loginAsRegularUser(): User
    {
        return create_regular_user();
    }
}
