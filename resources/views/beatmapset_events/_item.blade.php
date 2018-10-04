{{--
    Copyright 2015-2017 ppy Pty. Ltd.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License version 3
    as published by the Free Software Foundation.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}
@php
    $discussionId = isset($event->comment['beatmap_discussion_id']) ? $event->comment['beatmap_discussion_id'] : null;
    $discussionLink = route('beatmapsets.discussion', $event->beatmapset);
    if ($discussionId) {
        $discussionLink .= '#/'.$discussionId;
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
                    'discussion' => $discussionId ? "<a href='$discussionLink'>#$discussionId</a>" : '',
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
