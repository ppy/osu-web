{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="forum-topic-feature-vote">
    <div class="forum-topic-feature-vote__info">
        {!! trans('forum.topics.show.feature_vote.info._', [
            'feature_request' => '<strong>'.trans('forum.topics.show.feature_vote.info.feature_request').'</strong>',
            'supporters' => link_to(route('support-the-game'), trans('forum.topics.show.feature_vote.info.supporters'), ['class' => 'link link--default']),
        ]) !!}
    </div>

    <div
        class="
            forum-topic-feature-vote__votes
            {{ $topic->osu_starpriority > config('osu.forum.feature_topic_small_star_min') ? 'forum-topic-feature-vote__votes--small' : '' }}
        "
    >
        @foreach ($featureVotes as $username => $votes)
            <span class="forum-topic-feature-vote__vote" title="{{ $username }} (+{{ $votes }})">
                @for ($i = 0; $i < $votes; $i++)
                    <span class="forum-topic-feature-vote__star fas fa-star"></span>
                @endfor
            </span>
        @endforeach
    </div>

    <div>
        {{ trans('forum.topics.show.feature_vote.current', [
            'count' => i18n_number_format($topic->osu_starpriority),
        ]) }}
    </div>

    @if (Auth::check())
        <div class="forum-topic-feature-vote__button">
            <button
                class="btn-osu-big btn-osu-big--forum-primary"
                data-url="{{ route('forum.topics.vote-feature', $topic->getKey()) }}"
                data-method="POST"
                data-remote=1
                data-disable-with="{{ trans('common.buttons.saving') }}"
                @if (Auth::user()->osu_featurevotes < App\Models\Forum\FeatureVote::COST)
                    disabled
                @endif
            >
                {{ trans('forum.topics.show.feature_vote.do') }}
            </button>
        </div>

        <div class="forum-topic-feature-vote__remaining">
            {!! trans('forum.topics.show.feature_vote.user.current', [
                'votes' => '<strong>'.trans_choice('forum.topics.show.feature_vote.user.count', Auth::user()->osu_featurevotes).'</strong>',
            ]) !!}
        </div>
    @endif
</div>
