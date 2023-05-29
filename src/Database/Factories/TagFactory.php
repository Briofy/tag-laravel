<?php

namespace Database\Factories;

use Briofy\Tag\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    protected $model = Tag::class;

    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'slug' => $this->faker->slug(),
            'icon' => null,
        ];
    }
}
