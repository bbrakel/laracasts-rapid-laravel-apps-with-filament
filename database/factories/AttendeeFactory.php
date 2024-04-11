<?php

namespace Database\Factories;

use App\Models\Conference;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttendeeFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'ticket_cost' => 50000,
            'is_paid' => true,
            'created_at' => $this->faker->dateTimeBetween('-3 months', 'now')
        ];
    }

    public function forConference(Conference $conference): self
    {
        return $this->state([
            'conference_id' => $conference->id,
        ]);
    }

}
