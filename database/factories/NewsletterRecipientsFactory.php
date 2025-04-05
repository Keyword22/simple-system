<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\NewsletterRecipients;

class NewsletterRecipientsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NewsletterRecipients::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'email' => fake()->safeEmail(),
            'name' => fake()->name(),
            'subscribed_at' => fake()->dateTime(),
            'unsubscribed_at' => fake()->dateTime(),
            'enabled' => fake()->boolean(),
        ];
    }
}
