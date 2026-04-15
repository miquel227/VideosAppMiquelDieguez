<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    // ─── users.index ────────────────────────────────────────────────────────────

    #[Test]
    public function user_without_permissions_can_see_default_users_page(): void
    {
        // Arrange
        create_permissions();
        $user = create_regular_user();

        // Act
        $response = $this->actingAs($user)->get(route('users.index'));

        // Assert
        $response->assertStatus(200);
    }

    #[Test]
    public function user_with_permissions_can_see_default_users_page(): void
    {
        // Arrange
        create_permissions();
        $user = create_superadmin_user();

        // Act
        $response = $this->actingAs($user)->get(route('users.index'));

        // Assert
        $response->assertStatus(200);
    }

    #[Test]
    public function not_logged_users_cannot_see_default_users_page(): void
    {
        // Arrange
        create_permissions();

        // Act
        $response = $this->get(route('users.index'));

        // Assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    // ─── users.show ─────────────────────────────────────────────────────────────

    #[Test]
    public function user_without_permissions_can_see_user_show_page(): void
    {
        // Arrange
        create_permissions();
        $user   = create_regular_user();
        $target = User::factory()->create();

        // Act
        $response = $this->actingAs($user)->get(route('users.show', $target));

        // Assert
        $response->assertStatus(200);
    }

    #[Test]
    public function user_with_permissions_can_see_user_show_page(): void
    {
        // Arrange
        create_permissions();
        $user   = create_superadmin_user();
        $target = User::factory()->create();

        // Act
        $response = $this->actingAs($user)->get(route('users.show', $target));

        // Assert
        $response->assertStatus(200);
    }

    #[Test]
    public function not_logged_users_cannot_see_user_show_page(): void
    {
        // Arrange
        create_permissions();
        $target = User::factory()->create();

        // Act
        $response = $this->get(route('users.show', $target));

        // Assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }
}
