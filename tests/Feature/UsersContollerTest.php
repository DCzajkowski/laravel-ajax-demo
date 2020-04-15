<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersContollerTest extends TestCase
{
    use RefreshDatabase;

    public function testAllUsersAreReturned()
    {
        $users = factory(User::class, 10)->create();

        $response = $this->get('/api/users');

        $response->assertStatus(200);
        $response->assertJson($users->toArray());
    }

    public function testOnlyRelevantUsersAreReturnedBasedOnSearch()
    {
        $users = factory(User::class, 10)->create();
        $search = explode('@', $users->first()->email)[0];
        $relevantUsers = $users
            ->filter(function ($user) use ($search) {
                return strpos($user->email, $search) !== false;
            })
            ->toArray();

        $response = $this->get("/api/users?search=$search");

        $response->assertStatus(200);
        $response->assertJson($relevantUsers);
    }
}
