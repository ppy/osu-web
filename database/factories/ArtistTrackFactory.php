<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Database\Factories;

use App\Models\ArtistTrack;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArtistTrackFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ArtistTrack::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'genre' => $this->faker->word(),
            'bpm' => rand(100, 200),
            'length' => $this->faker->randomNumber(3),
            'preview' => $this->faker->url(),
            'osz' => $this->faker->url(),
        ];
    }
}
