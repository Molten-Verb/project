<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;

class RegistrationGoogleTest extends TestCase
{
    /**
     * @test
     */
    public function user_can_sign_in_with_google(): void
    {
        $googleUser = (object) [
            'id' => 'google-user-id',
            'name' => 'Google User',
            'email' => 'googleuser@example.com',
            'avatar' => 'https://www.example.com/avatar.jpg',
        ];

        Socialite::fake();
        Socialite::shouldReceive('driver->user')->andReturn($googleUser);

        $response = $this->get('/auth/redirect');

        $response->assertRedirect();

        $response = $this->get('/auth/callback');

        $user = User::where('google_id', $googleUser->id)->first();

        $this->assertNotNull($user);
        $this->assertEquals($googleUser->name, $user->name);
        $this->assertEquals($googleUser->email, $user->email);
        $this->assertTrue(Hash::check('12345678', $user->password));

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}
