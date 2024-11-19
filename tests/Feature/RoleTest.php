<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RoleTest extends TestCase
{
    /**
     * @test
     */
    public function table_roles_has_role_user()
    {
        $this->seedRoles();

        $this->assertDatabaseHas('roles', ['name' => 'user']);
    }

    /**
     * @test
     */
    public function user_has_role_after_registration()
    {
        $this->seedRoles();

        $name = fake()->name();
        $email = fake()->unique()->safeEmail();

        $data = [
            'name' => $name,
            'email' => $email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->post('/register', $data);

        $user = User::where('email', $email)->first();

        $this->assertDatabaseHas('model_has_roles', [
            'model_id' => $user->id,
            'role_id' => Role::where('name', 'user')->first()->id,
        ]);
    }

    public function test_guest_user_sees_only_home_and_racer_market_in_navigation()
    {
        $response = $this->get(route('market.index'));

        $response->assertSee('Домой');
        $response->assertDontSee('Кошелек');
        $response->assertDontSee('Мои пилоты');
    }
}
