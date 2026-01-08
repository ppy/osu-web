{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@foreach ($search->data() as $team)
    @php
        $url = route('teams.show', $team);
    @endphp
    <div
        class="team-card team-card--search"
        {!! background_image($team->header()->url()) !!}
    >
        <a class="team-card__link-bg" href="{{ $url }}"></a>

        <div class="team-card__col team-card__col--flag">
            @include('objects._flag_team', compact('team'))
        </div>

        <div class="team-card__col team-card__col--content">
            <h3 class="team-card__name">
                <a
                    href="{{ $url }}"
                    class="u-ellipsis-overflow u-hover link link--white link--no-underline"
                >
                    {{ $team->name }}
                </a>
                <small class="team-card__name-short">
                    [{{ $team->short_name }}]
                </small>
            </h3>

            <div class="team-card__members">
                {{ osu_trans_choice('teams.card.members', $team->members()->count()) }}
            </div>

            @php
                $leader = $team->leaderOrDeleted();
            @endphp
            <a
                class="team-card__leader-box u-hover js-usercard"
                data-user-id="{{ $leader->getKey() }}"
                href="{{ route('users.show', $leader) }}"
            >
                <span class="team-card__leader-icon">
                    <span class="fa fa-extra-team-leader"></span>
                </span>

                {{ $leader->username }}
            </a>
        </div>
        <div class="team-card__col team-card__col--sidebar">
            <span class="team-card__default-ruleset">
                <span class="fal fa-extra-mode-{{ App\Models\Beatmap::modeStr($team->default_ruleset_id) }}"></span>
            </span>
            <div
                class="js-react u-contents u-hover" data-react="team-extra-menu"
                data-props="{{ json_encode([
                    'leaderUsername' => $leader->username,
                    'teamId' => $team->getKey(),
                    'modifiers' => ['page-toggle', 'page-toggle-team-card'],
                ]) }}"
            >
                <div class="btn-circle btn-circle--page-toggle btn-circle--page-toggle-team-card">
                    <button class="popup-menu" type="button">
                        <span class="fas fa-ellipsis-v"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endforeach
