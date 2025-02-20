{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<ul class="team-members-leaderboard">
    @foreach ($leaderboard as $i => $stats)
        <li class="team-members-leaderboard-item">
            <div class="team-members-leaderboard-item__rank">
                #{{ i18n_number_format($i + 1) }}
            </div>
            <div class="team-members-leaderboard-item__username-container">
                <a
                    class="team-members-leaderboard-item__username js-usercard"
                    data-user-id="{{ $stats->user_id }}"
                    href="{{ route('users.show', $stats->user_id) }}"
                >
                    <span class="team-members-leaderboard-item__avatar">
                        <span
                            class="avatar avatar--full avatar--guest"
                            {!! background_image($stats->user->user_avatar) !!}
                        ></span>
                    </span>

                    {{ $stats->user->username }}
                </a>
            </div>
            <div class="team-members-leaderboard-item__numbers">
                <div class="team-members-leaderboard-item__number">
                    <div class="team-members-leaderboard-item__number-title">
                        {{ osu_trans('teams.leaderboard.total_score') }}
                    </div>
                    <div>
                        {{ i18n_number_format($stats->total_score) }}
                    </div>
                </div>
                <div class="team-members-leaderboard-item__number">
                    <div class="team-members-leaderboard-item__number-title">
                        {{ osu_trans('teams.leaderboard.performance') }}
                    </div>
                    <div>
                        {{ i18n_number_format($stats->pp()) ?? '-' }}
                    </div>
                </div>
                <div class="team-members-leaderboard-item__number">
                    <div class="team-members-leaderboard-item__number-title">
                        {{ osu_trans('teams.leaderboard.global_rank') }}
                    </div>
                    <div>
                        {{ i18n_number_format($stats->globalRank()) ?? '-' }}
                    </div>
                </div>
            </div>
    @endforeach
</ul>
