<?php

namespace Tests\Feature\Auth;

use Mockery;
use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;

class RegistrationGoogleTest extends TestCase
{
    /**
     * @test
     */
    public function user_can_sign_in_with_google(): void
    {
        $this->seedRoles();

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

        $user = User::where('email', 'test@test.com')->first();

        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'email' => $user->email,
        ]);

        $this->assertDatabaseHas('model_has_roles', [
            'model_id' => $user->id,
            'role_id' => Role::where('name', 'user')->first()->id,
        ]);

        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}
