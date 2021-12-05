<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\GraphQL\Resolvers;

use App\Models\Beatmap;
use App\Models\Score\Best\Model as BestModel;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class BeatmapResolver
{
    private function baseScoreQuery(Beatmap $beatmap, array $args)
    {
        return BestModel::getClassByString($args['mode'] ?? $beatmap->mode)
            ::default()
            ->where('beatmap_id', $beatmap->getKey())
            ->withMods($args['mods'] ?? []);
    }

    public function userScore(Beatmap $beatmap, array $args, GraphQLContext $context)
    {
        $query = $this->baseScoreQuery($beatmap, $args);

        /** @var \App\Models\User $user */
        $user = $context->user();
        $targetUser = $args['user'] ?? null;

        if (array_has($args, 'user')) {
            $query = $query->visibleUsers();
        } else {
            if ($user === null) {
                // TODO: throw an exception informing clients of missing argument
                return null;
            } else {
                $targetUser = $user->user_id;
            }
        }

        return $query
            ->where('user_id', $targetUser)
            ->first();
    }

    public function bestScores(Beatmap $beatmap, array $args, GraphQLContext $context)
    {
        return $this->baseScoreQuery($beatmap, $args)
            ->withType($args['type'] ?? 'global', ['user' => $context->user()])
            ->visibleUsers();
    }
}
