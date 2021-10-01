{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}

@php
    $beatmapset = $post->beatmapDiscussion->beatmapset;
@endphp

<div class="beatmap-discussions__discussion beatmapset-activities__discussion-post">
    <div class="beatmap-discussion beatmap-discussion--single beatmapset-activities__post-grow">
        <div class="beatmap-discussion-timestamp__icons-container">
            <div class="beatmap-discussion-timestamp__icons">
                <a class="beatmap-discussion-timestamp__link-plain" href="{{ route('beatmapsets.discussion', $beatmapset) }}#/{{ $post->beatmap_discussion_id }}">
                    <img class='beatmapset-cover'
                        src="{{$beatmapset->coverURL('list')}}"
                        srcSet="{{$beatmapset->coverURL('list')}} 1x, {{$beatmapset->coverURL('list@2x')}} 2x">
                </a>
                <div class="beatmap-discussion-timestamp__icon beatmapset-activities__timeline-icon-margin">
                    <span class="fas fa-reply" title="{{ osu_trans('common.buttons.reply') }}"></span>
                </div>
            </div>
        </div>
        <div class="beatmap-discussion__discussion">
            <div class="beatmap-discussion__top">
                <div class="beatmap-discussion-post beatmap-discussion-post--discussion">
                    <div class="beatmap-discussion-post__content">
                        @include('beatmapset_activities._user', ['user' => $post->user])

                        <div class="beatmap-discussion-post__message-container">
                            <div class="beatmap-discussion-post__message">
                                @if ($post->system)
                                    @php
                                        $message = $post->message;
                                        $messageValue = $message['value'];
                                        $isResolving = $message['type'] === 'resolved';
                                    @endphp
                                    @if ($isResolving)
                                        @php
                                            $messageValue = $message['value'] ? 'true' : 'false';
                                        @endphp
                                        @if ($message['value'])
                                            <i class="fas fa-check-circle"></i>
                                        @else
                                            <i class="fas fa-times-circle"></i>
                                        @endif
                                    @endif

                                    {{ osu_trans("beatmap_discussions.system.{$message['type']}.{$messageValue}", ['user' => $post->user->username]) }}
                                @else
                                    {{ $post->message }}
                                @endif
                            </div>
                            <div class="beatmap-discussion-post__info-container">
                                <span class="beatmap-discussion-post__info">{!! timeago($post->created_at) !!}</span>
                                @if ($post->deleted_at !== null)
                                    <span class="beatmap-discussion-post__info">
                                        {{ osu_trans('beatmap_discussions.item.deleted_at') }}: {!! timeago($post->deleted_at) !!}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
