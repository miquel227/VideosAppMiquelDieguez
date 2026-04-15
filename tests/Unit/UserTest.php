<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_is_not_superadmin_by_default(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act & Assert
        $this->assertFalse($user->isSuperAdmin());
    }

    public function test_user_is_superadmin_when_super_admin_is_true(): void
    {
        // Arrange
        $user = User::factory()->create(['super_admin' => true]);

        // Act & Assert
        $this->assertTrue($user->isSuperAdmin());
    }
}
