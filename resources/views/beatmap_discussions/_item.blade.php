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
    $postTypeToIcon = [
      'hype' => 'fas fa-bullhorn',
      'mapper_note' => 'far fa-sticky-note',
      'praise' => 'fas fa-heart',
      'problem' => 'fas fa-exclamation-circle',
      'suggestion' => 'far fa-circle',
    ];
@endphp
<div class="beatmap-discussions__discussion beatmapset-activities__discussion-post">
    <div class="beatmap-discussion beatmapset-activities__post-grow{{ $discussion->trashed() ? ' beatmap-discussion--deleted' : ''}}">
        <div class="beatmap-discussion-timestamp__icons-container">
            <div class="beatmap-discussion-timestamp__icons">
                <a href="{{ route('beatmapsets.discussion', $discussion->beatmapset) }}#/{{ $discussion->getKey() }}">
                    <img class='beatmapset-activities__beatmapset-cover'
                        src="{{$discussion->beatmapset->coverURL('list')}}"
                        srcSet="{{$discussion->beatmapset->coverURL('list')}} 1x, {{$discussion->beatmapset->coverURL('list@2x')}} 2x">
                </a>
                <div class="beatmap-discussion-timestamp__icon beatmapset-activities__timeline-icon-margin">
                    <span class="beatmap-discussion-message-type beatmap-discussion-message-type--{{$discussion->message_type}}">
                        <span class="{{$postTypeToIcon[$discussion->message_type]}}"></span>
                    </span>
                </div>
            </div>
        </div>
        <div class="beatmap-discussion__discussion">
            <div class="beatmap-discussion__top">
                <div class="beatmap-discussion-post beatmap-discussion-post--discussion">
                    <div class="beatmap-discussion-post__content">
                        @include('beatmapset_activities._user', ['user' => $discussion->user])

                        <div class="beatmap-discussion-post__message-container">
                            <div class="beatmap-discussion-post__message">{{$discussion->startingPost->message}}</div>
                            <div class="beatmap-discussion-post__info-container">
                                <span class="beatmap-discussion-post__info">{!! timeago($discussion->created_at) !!}</span>
                                @if ($discussion->deleted_at !== null)
                                    <span class="beatmap-discussion-post__info">
                                        {{ trans('beatmap_discussions.item.deleted_at') }}: {!! timeago($discussion->deleted_at) !!}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($discussion->resolved)
                <div class="beatmap-discussion__line beatmap-discussion__line--resolved"></div>
            @endif
        </div>
    </div>
</div>
