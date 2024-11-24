<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReviewTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_review()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post('/reviews', [
            'titulo' => 'Gran libro',
            'review' => 'Me encantó el contenido.',
            'fecha' => now()->format('Y-m-d'),
            'libro_id' => 1,
        ]);

        $response->assertStatus(302); // Redirige después de crear.
        $this->assertDatabaseHas('reviews', [
            'titulo' => 'Gran libro',
        ]);
    }
}