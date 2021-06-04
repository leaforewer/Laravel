<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class HomeController extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/home');

        $response->assertStatus(200)
        ->assertSeeText('You are logged in');
    }

    public function testLoggedOut()
    {
        
        $response = $this->get('/home');

        $response->assertStatus(302)
        ->assertRedirect('/login');
    }
}
