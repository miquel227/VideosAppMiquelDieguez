<?php

namespace Tests\Feature\Videos;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class VideosManageControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function user_with_permissions_can_manage_videos(): void
    {
        // Arrange
        create_permissions();
        $user = $this->loginAsVideoManager();

        // Act
        $response = $this->actingAs($user)->get(route('videos.manage'));

        // Assert
        $response->assertStatus(200);
    }

    #[Test]
    public function regular_users_cannot_manage_videos(): void
    {
        // Arrange
        create_permissions();
        $user = $this->loginAsRegularUser();

        // Act
        $response = $this->actingAs($user)->get(route('videos.manage'));

        // Assert
        $response->assertStatus(403);
    }

    #[Test]
    public function guest_users_cannot_manage_videos(): void
    {
        // Arrange
        create_permissions();

        // Act
        $response = $this->get(route('videos.manage'));

        // Assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    #[Test]
    public function superadmins_can_manage_videos(): void
    {
        // Arrange
        create_permissions();
        $user = $this->loginAsSuperAdmin();

        // Act
        $response = $this->actingAs($user)->get(route('videos.manage'));

        // Assert
        $response->assertStatus(200);
    }

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
