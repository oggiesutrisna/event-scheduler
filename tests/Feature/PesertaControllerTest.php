<?php

namespace Tests\Feature;

use App\Models\Peserta;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PesertaControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /** @test */
    public function redirected_to_login_page()
    {
        $response = $this->post('/peserta');

        $response->assertStatus(302);
    }

    /** @test */
    public function validation_fail()
    {
        $response = $this->actingAs($this->user)->post('/peserta', []);

        $response->assertSessionHasErrors([
            'nama',
            'ttl',
            'alamat',
            'instansi',
            'password'
        ]);
    }

    /** @test */
    public function successfully_create_new_peserta()
    {
        $this->assertEquals(0, Peserta::count());

        $response = $this->actingAs($this->user)->post('/peserta', [
            'nama' => $this->faker->name(),
            'ttl' => $this->faker->city(),
            'alamat' => $this->faker->address(),
            'instansi' => 'Foo Bar',
            'password' => 'password',
        ]);

        $this->assertEquals(1, Peserta::count());
    }
}
