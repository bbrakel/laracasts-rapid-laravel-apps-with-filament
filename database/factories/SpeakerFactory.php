<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Speaker;
use App\Models\Talk;

class SpeakerFactory extends Factory
{
    protected $model = Speaker::class;

    public function definition(): array
    {
        $qualificationsCount = $this->faker->numberBetween(0, 10);
        $qualifications = $this->faker->randomElement(array_keys(Speaker::QUALIFICATIONS), $qualificationsCount);

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'qualifications' => $qualifications,
            'bio' => $this->faker->text(),
            'twitter_handle' => $this->faker->word(),
        ];
    }

    public function withTalks(int $count = 1): self
    {
        return $this->has(Talk::factory()->count($count), 'talks');
    }
}
