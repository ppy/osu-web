<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Database\Factories;

use App\Models\NewsPost;

class NewsPostFactory extends Factory
{
    protected $model = NewsPost::class;

    public function definition(): array
    {
        return [
            'page' => [
                'toc' => (object) [],
                'author' => 'news',
                'header' => [
                    'date' => now(),
                    'title' => $this->faker->sentence(),
                    'layout' => 'post',
                ],
                'output' => 'I am News.',
                'firstImage' => null,
            ],
            'slug' => fn () => $this->faker->date().'-'.$this->faker->slug(),
        ];
    }

    public function series(?string $series): static
    {
        if ($series === null) {
            return $this;
        }

        return $this->state(function (array $attrs) use ($series) {
            $attrs['page']['header']['series'] = $series;
            return $attrs;
        });
    }
}
