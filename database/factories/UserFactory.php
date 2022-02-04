<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Country;
use App\Models\User;
use App\Models\UserAccountHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    const DEFAULT_PASSWORD = 'password';

    private static function defaultPasswordHash()
    {
        static $password;

        return $password ??= password_hash(md5(static::DEFAULT_PASSWORD), PASSWORD_BCRYPT);
    }

    protected $model = User::class;

    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            if (!$user->exists) {
                throw new \Exception($user->validationErrors()->toSentence());
            }

            $user->addToGroup(app('groups')->byIdOrFail($user->group_id));
        });
    }

    public function definition(): array
    {
        // Get or create a random country
        $countryAcronym = fn () => Country::inRandomOrder()->first() ?? Country::factory()->create();

        return [
            'username' => fn () => substr(str_replace('.', ' ', $this->faker->unique()->userName()), 0, 15),
            'user_password' => static::defaultPasswordHash(),
            'user_email' => fn () => $this->faker->unique()->safeEmail(),
            'group_id' => fn () => app('groups')->byIdentifier('default'),
            'user_lastvisit' => time(),
            'user_posts' => rand(1, 500),
            'user_warnings' => 0,
            'user_type' => 0,
            'osu_kudosavailable' => rand(1, 500),
            'osu_kudosdenied' => rand(1, 500),
            'osu_kudostotal' => rand(1, 500),
            'country_acronym' => $countryAcronym,
            'osu_playstyle' => [array_rand(User::PLAYSTYLES)],
            'user_website' => 'http://www.google.com/',
            'user_twitter' => 'ppy',
            'user_permissions' => '',
            'user_interests' => fn () => mb_substr($this->faker->bs(), 0, 30),
            'user_occ' => fn () => mb_substr($this->faker->catchPhrase(), 0, 30),
            'user_sig' => fn () => $this->faker->realText(155),
            'user_from' => fn () => mb_substr($this->faker->country(), 0, 30),
            'user_regdate' => fn () => $this->faker->dateTimeBetween('-6 years'),
        ];
    }

    public function restricted()
    {
        return $this
            ->state(['user_warnings' => 1])
            ->has(UserAccountHistory::factory()->restriction(), 'accountHistories');
    }

    public function silenced()
    {
        return $this->has(UserAccountHistory::factory()->silence(), 'accountHistories');
    }

    public function supporter()
    {
        return $this->state(['osu_subscriber' => true, 'osu_subscriptionexpiry' => now()->addMonthNoOverflow(1)]);
    }

    public function withGroup(?string $groupIdentifier, ?array $playmodes = null)
    {
        if ($groupIdentifier === null) {
            return $this;
        }

        $group = app('groups')->byIdentifier($groupIdentifier);

        return $this
            ->state(['group_id' => $group])
            ->afterCreating(function (User $user) use ($group, $playmodes) {
                $user->addToGroup($group);

                if ($playmodes !== null) {
                    if (!$group->has_playmodes) {
                        $group->update(['has_playmodes' => true]);

                        // TODO: This shouldn't have to be called here, since it's already
                        // called by `Group::afterCommit`, but `Group::afterCommit` isn't
                        // running in tests when creating/saving `Group`s.
                        app('groups')->resetCache();
                    }

                    $user->findUserGroup($group, true)->update(['playmodes' => $playmodes]);
                }
            });
    }

    public function withNote()
    {
        return $this->has(UserAccountHistory::factory(), 'accountHistories');
    }

    public function withPlays(?int $count = null, ?string $mode = 'osu')
    {
        $sMode = studly_case($mode);

        return $this->has("App\\Models\\UserStatistics\\{$sMode}"::factory()->state([
            'playcount' => $count ?? config('osu.user.min_plays_for_posting'),
        ]), "statistics{$sMode}");
    }
}
