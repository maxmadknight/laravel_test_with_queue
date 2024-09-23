<?php

namespace Tests\Feature;

use App\Jobs\ProcessSubmission;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Queue;

class SubmissionTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     */
    public function test_submission_is_processed(): void
    {
        Queue::fake();

        $response = $this->postJson('/api/submit', [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'message' => $this->faker->text,
        ]);

        $response->assertStatus(200);

        Queue::assertPushed(ProcessSubmission::class);
    }

    public function test_submission_is_not_processed(): void
    {
        Queue::fake();

        $response = $this->postJson('/api/submit', [
            'name' => '',
            'email' => '',
            'message' => '',
        ]);

        $response->assertStatus(422);

        Queue::assertNotPushed(ProcessSubmission::class);
    }

    public function test_submission_is_not_processed_with_invalid_email(): void
    {
        Queue::fake();

        $response = $this->postJson('/api/submit', [
            'name' => $this->faker->name,
            'email' => 'invalid-email',
            'message' => $this->faker->text,
        ]);

        $response->assertStatus(422);

        Queue::assertNotPushed(ProcessSubmission::class);
    }

    public function test_submission_is_not_processed_with_invalid_message(): void
    {
        Queue::fake();

        $response = $this->postJson('/api/submit', [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'message' => '',
        ]);

        $response->assertStatus(422);

        Queue::assertNotPushed(ProcessSubmission::class);
    }

    public function test_submission_is_not_processed_with_invalid_name(): void
    {
        Queue::fake();

        $response = $this->postJson('/api/submit', [
            'name' => '',
            'email' => $this->faker->email,
            'message' => $this->faker->text,
        ]);

        $response->assertStatus(422);

        Queue::assertNotPushed(ProcessSubmission::class);
    }
}
