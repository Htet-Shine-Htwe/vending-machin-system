<?php
namespace Tests\Feature\Api\Auth;


use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Tests\TestCase;

class AuthApiControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test user registration.
     *
     * @return void
     */
    public function test_user_can_register()
    {
        $this->seed(RolePermissionSeeder::class);
        $response = $this->postJson(route('api.register'), [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'message',
                     'user' => [
                         'id',
                         'name',
                         'email',
                         'created_at',
                         'updated_at'
                     ],
                     'authorization' => [
                         'token',
                         'type'
                     ]
                 ]);

        $this->assertDatabaseHas('users', [
            'email' => 'johndoe@example.com'
        ]);
    }

    /**
     * Test user login with correct credentials.
     *
     * @return void
     */
    public function test_user_can_login_with_correct_credentials()
    {
        $user = User::factory()->create([
            'email' => 'johndoe@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->postJson(route('api.login'), [
            'email' => 'johndoe@example.com',
            'password' => 'password123'
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'access_token',
                     'token_type',
                     'expires_in'
                 ]);
    }

    /**
     * Test user login with incorrect credentials.
     *
     * @return void
     */
    public function test_user_cannot_login_with_incorrect_credentials()
    {
        User::factory()->create([
            'email' => 'johndoe@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->postJson(route('api.login'), [
            'email' => 'johndoe@example.com',
            'password' => 'wrongpassword'
        ]);

        $response->assertStatus(401)
                 ->assertJson([
                     'status' => 'error',
                     'message' => 'Unauthorized'
                 ]);
    }

    /**
     * Test user logout.
     *
     * @return void
     */
    public function test_user_can_logout()
    {
        $user = User::factory()->create();

        $token = JWTAuth::fromUser($user);

        $response = $this->withHeader('Authorization', "Bearer $token")
                         ->postJson(route('api.logout'));

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Successfully logged out'
                 ]);
    }

    /**
     * Test token refresh.
     *
     * @return void
     */
    public function test_user_can_refresh_token()
    {
        $user = User::factory()->create();

        $token = JWTAuth::fromUser($user);

        $response = $this->withHeader('Authorization', "Bearer $token")
                         ->postJson(route('api.refresh'));

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'user' => [
                         'id',
                         'name',
                         'email'
                     ],
                     'authorization' => [
                         'token',
                         'type'
                     ]
                 ]);
    }
}
