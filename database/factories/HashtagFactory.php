<?php

namespace Database\Factories;

use App\Models\Hashtag;
use Illuminate\Database\Eloquent\Factories\Factory;

class HashtagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Hashtag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'contents' => $this->faker->word(),
        ];
    }
}
