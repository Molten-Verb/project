<?php

namespace Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use Mockery;
use Tests\TestCase;

class RegistrationGoogleTest extends TestCase
{
    /**
     * @test
     */
    public function user_can_sign_in_with_google(): void
    {
        $abstractUser = Mockery::mock('Laravel\Socialite\Two\User');
        $abstractUser->shouldReceive('getId')
            ->andReturn(1234567890)
            ->shouldReceive('getEmail')
            ->andReturn('test@test.com')
            ->shouldReceive('getName')
            ->andReturn('User Test')
            ->shouldReceive('getAvatar')
            ->andReturn('https://avatar.com/userimage');

        $provider = Mockery::mock('Laravel\Socialite\Contracts\Provider');
        $provider->shouldReceive('user')->andReturn($abstractUser);

        Socialite::shouldReceive('driver')->with('google')->andReturn($provider);

        $response = $this->get(route('google.callback'));

        $this->assertDatabaseHas('users', [
            'name' => 'User Test',
            'email' => 'test@test.com',
        ]);

        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}
