<?php

namespace Tests\Feature\Videos;

use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class VideosManageControllerTest extends TestCase
{
    use RefreshDatabase;

    // ─── Tests del Sprint 3 ──────────────────────────────────────────────────

    #[Test]
    public function user_with_permissions_can_manage_videos(): void
    {
        // Arrange
        create_permissions();
        $videos = Video::factory()->count(3)->create();
        $user = $this->loginAsVideoManager();

        // Act
        $response = $this->actingAs($user)->get(route('videos.manage'));

        // Assert
        $response->assertStatus(200);
        foreach ($videos as $video) {
            $response->assertSee($video->title);
        }
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

    // ─── Tests del Sprint 4: CREATE ──────────────────────────────────────────

    #[Test]
    public function user_with_permissions_can_see_add_videos(): void
    {
        // Arrange
        create_permissions();
        $user = $this->loginAsVideoManager();

        // Act
        $response = $this->actingAs($user)->get(route('videos.manage.create'));

        // Assert
        $response->assertStatus(200);
    }

    #[Test]
    public function user_without_videos_manage_create_cannot_see_add_videos(): void
    {
        // Arrange
        create_permissions();
        $user = $this->loginAsRegularUser();

        // Act
        $response = $this->actingAs($user)->get(route('videos.manage.create'));

        // Assert
        $response->assertStatus(403);
    }

    #[Test]
    public function user_with_permissions_can_store_videos(): void
    {
        // Arrange
        create_permissions();
        $user = $this->loginAsVideoManager();

        // Act
        $response = $this->actingAs($user)->post(route('videos.manage.store'), [
            'title'       => 'Nou vídeo de prova',
            'description' => 'Descripció del nou vídeo',
            'url'         => 'https://www.youtube.com/watch?v=testVideo123',
        ]);

        // Assert
        $response->assertStatus(302);
        $response->assertRedirect(route('videos.manage'));
    }

    #[Test]
    public function user_without_permissions_cannot_store_videos(): void
    {
        // Arrange
        create_permissions();
        $user = $this->loginAsRegularUser();

        // Act
        $response = $this->actingAs($user)->post(route('videos.manage.store'), [
            'title'       => 'Nou vídeo de prova',
            'description' => 'Descripció del nou vídeo',
            'url'         => 'https://www.youtube.com/watch?v=testVideo123',
        ]);

        // Assert
        $response->assertStatus(403);
    }

    // ─── Tests del Sprint 4: EDIT / UPDATE ───────────────────────────────────

    #[Test]
    public function user_with_permissions_can_see_edit_videos(): void
    {
        // Arrange
        create_permissions();
        $video = Video::factory()->create();
        $user  = $this->loginAsVideoManager();

        // Act
        $response = $this->actingAs($user)->get(route('videos.manage.edit', $video));

        // Assert
        $response->assertStatus(200);
        $response->assertSee($video->title);
    }

    #[Test]
    public function user_without_permissions_cannot_see_edit_videos(): void
    {
        // Arrange
        create_permissions();
        $video = Video::factory()->create();
        $user  = $this->loginAsRegularUser();

        // Act
        $response = $this->actingAs($user)->get(route('videos.manage.edit', $video));

        // Assert
        $response->assertStatus(403);
    }

    #[Test]
    public function user_with_permissions_can_update_videos(): void
    {
        // Arrange
        create_permissions();
        $video = Video::factory()->create();
        $user  = $this->loginAsVideoManager();

        // Act
        $response = $this->actingAs($user)->put(route('videos.manage.update', $video), [
            'title'       => 'Títol actualitzat',
            'description' => 'Descripció actualitzada',
            'url'         => $video->url,
        ]);

        // Assert
        $response->assertStatus(302);
        $response->assertRedirect(route('videos.manage'));
    }

    #[Test]
    public function user_without_permissions_cannot_update_videos(): void
    {
        // Arrange
        create_permissions();
        $video = Video::factory()->create();
        $user  = $this->loginAsRegularUser();

        // Act
        $response = $this->actingAs($user)->put(route('videos.manage.update', $video), [
            'title'       => 'Títol actualitzat',
            'description' => 'Descripció actualitzada',
            'url'         => $video->url,
        ]);

        // Assert
        $response->assertStatus(403);
    }

    // ─── Tests del Sprint 4: DELETE / DESTROY ────────────────────────────────

    #[Test]
    public function user_with_permissions_can_destroy_videos(): void
    {
        // Arrange
        create_permissions();
        $video = Video::factory()->create();
        $user  = $this->loginAsVideoManager();

        // Act
        $response = $this->actingAs($user)->delete(route('videos.manage.destroy', $video));

        // Assert
        $response->assertStatus(302);
        $response->assertRedirect(route('videos.manage'));
    }

    #[Test]
    public function user_without_permissions_cannot_destroy_videos(): void
    {
        // Arrange
        create_permissions();
        $video = Video::factory()->create();
        $user  = $this->loginAsRegularUser();

        // Act
        $response = $this->actingAs($user)->delete(route('videos.manage.destroy', $video));

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
