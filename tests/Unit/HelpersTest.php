<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class HelpersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_default_user_can_be_created(): void
    {
        // Arrange
        $userData = config('users.default_user');

        // Act
        $user = defaultUser();

        // Assert
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($userData['name'], $user->name);
        $this->assertEquals($userData['email'], $user->email);
        $this->assertTrue(Hash::check($userData['password'], $user->password));
        $this->assertNotNull($user->currentTeam);
    }

    /** @test */
    public function test_default_professor_can_be_created(): void
    {
        // Arrange
        $professorData = config('users.default_professor');

        // Act
        $professor = defaultProfessor();

        // Assert
        $this->assertInstanceOf(User::class, $professor);
        $this->assertEquals($professorData['name'], $professor->name);
        $this->assertEquals($professorData['email'], $professor->email);
        $this->assertTrue(Hash::check($professorData['password'], $professor->password));
        $this->assertNotNull($professor->currentTeam);
    }

    /** @test */
    public function test_default_user_is_not_duplicated_when_called_twice(): void
    {
        // Arrange & Act
        defaultUser();
        defaultUser();

        // Assert
        $this->assertEquals(1, User::where('email', config('users.default_user.email'))->count());
    }

    /** @test */
    public function test_default_professor_is_not_duplicated_when_called_twice(): void
    {
        // Arrange & Act
        defaultProfessor();
        defaultProfessor();

        // Assert
        $this->assertEquals(1, User::where('email', config('users.default_professor.email'))->count());
    }

    /** @test */
    public function test_default_user_and_professor_have_different_emails(): void
    {
        // Arrange & Act
        $user      = defaultUser();
        $professor = defaultProfessor();

        // Assert
        $this->assertNotEquals($user->email, $professor->email);
    }

    /** @test */
    public function test_default_video_can_be_created(): void
    {
        // Arrange
        $videoData = config('videos.default_video');

        // Act
        $video = defaultVideo();

        // Assert
        $this->assertInstanceOf(Video::class, $video);
        $this->assertEquals($videoData['title'], $video->title);
        $this->assertEquals($videoData['url'], $video->url);
        $this->assertNotNull($video->published_at);
    }

    /** @test */
    public function test_default_video_is_not_duplicated_when_called_twice(): void
    {
        // Arrange & Act
        defaultVideo();
        defaultVideo();

        // Assert
        $this->assertEquals(1, Video::where('title', config('videos.default_video.title'))->count());
    }
}
