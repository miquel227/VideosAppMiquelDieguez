<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UsersManageControllerTest extends TestCase
{
    use RefreshDatabase;

    // ─── Accés al CRUD d'usuaris ─────────────────────────────────────────────

    #[Test]
    public function user_with_permissions_can_manage_users(): void
    {
        // Arrange
        create_permissions();
        $user = $this->loginAsSuperAdmin();

        // Act
        $response = $this->actingAs($user)->get(route('users.manage'));

        // Assert
        $response->assertStatus(200);
    }

    #[Test]
    public function regular_users_cannot_manage_users(): void
    {
        // Arrange
        create_permissions();
        $user = $this->loginAsRegularUser();

        // Act
        $response = $this->actingAs($user)->get(route('users.manage'));

        // Assert
        $response->assertStatus(403);
    }

    #[Test]
    public function guest_users_cannot_manage_users(): void
    {
        // Arrange
        create_permissions();

        // Act
        $response = $this->get(route('users.manage'));

        // Assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    #[Test]
    public function superadmins_can_manage_users(): void
    {
        // Arrange
        create_permissions();
        $user = $this->loginAsSuperAdmin();

        // Act
        $response = $this->actingAs($user)->get(route('users.manage'));

        // Assert
        $response->assertStatus(200);
    }

    // ─── CREATE ──────────────────────────────────────────────────────────────

    #[Test]
    public function user_with_permissions_can_see_add_users(): void
    {
        // Arrange
        create_permissions();
        $user = $this->loginAsSuperAdmin();

        // Act
        $response = $this->actingAs($user)->get(route('users.manage.create'));

        // Assert
        $response->assertStatus(200);
    }

    #[Test]
    public function user_without_users_manage_create_cannot_see_add_users(): void
    {
        // Arrange
        create_permissions();
        $user = $this->loginAsRegularUser();

        // Act
        $response = $this->actingAs($user)->get(route('users.manage.create'));

        // Assert
        $response->assertStatus(403);
    }

    #[Test]
    public function user_with_permissions_can_store_users(): void
    {
        // Arrange
        create_permissions();
        $user = $this->loginAsSuperAdmin();

        // Act
        $response = $this->actingAs($user)->post(route('users.manage.store'), [
            'name'     => 'Nou Usuari Test',
            'email'    => 'nouusuari@test.com',
            'password' => '123456789',
        ]);

        // Assert
        $response->assertStatus(302);
        $response->assertRedirect(route('users.manage'));
    }

    #[Test]
    public function user_without_permissions_cannot_store_users(): void
    {
        // Arrange
        create_permissions();
        $user = $this->loginAsRegularUser();

        // Act
        $response = $this->actingAs($user)->post(route('users.manage.store'), [
            'name'     => 'Nou Usuari Test',
            'email'    => 'nouusuari@test.com',
            'password' => '123456789',
        ]);

        // Assert
        $response->assertStatus(403);
    }

    // ─── EDIT / UPDATE ───────────────────────────────────────────────────────

    #[Test]
    public function user_with_permissions_can_see_edit_users(): void
    {
        // Arrange
        create_permissions();
        $target = User::factory()->create();
        $user   = $this->loginAsSuperAdmin();

        // Act
        $response = $this->actingAs($user)->get(route('users.manage.edit', $target));

        // Assert
        $response->assertStatus(200);
        $response->assertSee($target->name);
    }

    #[Test]
    public function user_without_permissions_cannot_see_edit_users(): void
    {
        // Arrange
        create_permissions();
        $target = User::factory()->create();
        $user   = $this->loginAsRegularUser();

        // Act
        $response = $this->actingAs($user)->get(route('users.manage.edit', $target));

        // Assert
        $response->assertStatus(403);
    }

    #[Test]
    public function user_with_permissions_can_update_users(): void
    {
        // Arrange
        create_permissions();
        $target = User::factory()->create();
        $user   = $this->loginAsSuperAdmin();

        // Act
        $response = $this->actingAs($user)->put(route('users.manage.update', $target), [
            'name'  => 'Nom Actualitzat',
            'email' => $target->email,
        ]);

        // Assert
        $response->assertStatus(302);
        $response->assertRedirect(route('users.manage'));
    }

    #[Test]
    public function user_without_permissions_cannot_update_users(): void
    {
        // Arrange
        create_permissions();
        $target = User::factory()->create();
        $user   = $this->loginAsRegularUser();

        // Act
        $response = $this->actingAs($user)->put(route('users.manage.update', $target), [
            'name'  => 'Nom Actualitzat',
            'email' => $target->email,
        ]);

        // Assert
        $response->assertStatus(403);
    }

    // ─── DELETE / DESTROY ────────────────────────────────────────────────────

    #[Test]
    public function user_with_permissions_can_destroy_users(): void
    {
        // Arrange
        create_permissions();
        $target = User::factory()->create();
        $user   = $this->loginAsSuperAdmin();

        // Act
        $response = $this->actingAs($user)->delete(route('users.manage.destroy', $target));

        // Assert
        $response->assertStatus(302);
        $response->assertRedirect(route('users.manage'));
    }

    #[Test]
    public function user_without_permissions_cannot_destroy_users(): void
    {
        // Arrange
        create_permissions();
        $target = User::factory()->create();
        $user   = $this->loginAsRegularUser();

        // Act
        $response = $this->actingAs($user)->delete(route('users.manage.destroy', $target));

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
