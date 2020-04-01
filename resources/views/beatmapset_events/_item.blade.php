{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $discussionId = isset($event->comment['beatmap_discussion_id']) ? $event->comment['beatmap_discussion_id'] : null;
    if ($event->beatmapset !== null) {
        $discussionLink = route('beatmapsets.discussion', ['beatmapset' => $event->beatmapset]);
        if ($discussionId !== null) {
            $discussionLink .= '#/'.$discussionId;
        }
    } else {
        $discussionLink = null;
    }

    if (isset($discussionId)) {
        $discussionLinkHtml = "#{$discussionId}";

        if (isset($discussionLink)) {
            $discussionLinkHtml = tag('a', ['href' => $discussionLink], $discussionLinkHtml);
        }
    } else {
        $discussionLinkHtml = '';
    }

    if ($event->beatmapset !== null) {
        if ($event->beatmapset->user !== null) {
            $mapper = $event->beatmapset->user->username;
        } else {
            $mapper = trans('users.deleted');
        }
    }
@endphp
<div class='beatmapset-events__event'>
    <div class="beatmapset-event">
        @if ($event->beatmapset === null)
            <span>deleted<br>beatmap</span>
        @else
            <a
                href="{{ $discussionLink }}"
                title="
                    {{ $event->beatmapset->title }} - {{ $event->beatmapset->artist }}
                    ({{ trans('beatmapsets.show.details.mapped_by', ['mapper' => $mapper]) }})
                "
            >
                <img class='beatmapset-activities__beatmapset-cover'

                        src="{{$event->beatmapset->coverURL('list')}}"
                        srcSet="{{$event->beatmapset->coverURL('list')}} 1x, {{$event->beatmapset->coverURL('list@2x')}} 2x"
                >
            </a>
        @endif
        <div class="beatmapset-event__icon beatmapset-event__icon--{{str_replace('_', '-', $event->type)}} beatmapset-activities__event-icon-spacer"></div>
        <div>
            <div class="beatmapset-event__content">
                {!! trans('beatmapset_events.event.'.$event->typeForTranslation(), [
                    'user' => link_to_user($event->user),
                    'discussion' => $discussionLinkHtml,
                    'text' => is_string($event->comment) ? $event->comment : '[no preview]',
                ]) !!}
            </div>
            <div>{!! timeago($event->created_at) !!}</div>
            @if (optional($event->beatmapset)->deleted_at !== null)
                <span class="beatmap-discussion-post__info">
                    {{ trans('beatmap_discussions.item.deleted_at') }}: {!! timeago($event->beatmapset->deleted_at) !!}
                </span>
            @endif
        </div>
    </div>
</div>
