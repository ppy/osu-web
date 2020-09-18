{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}

<div class="beatmap-discussions__discussion beatmapset-activities__discussion-post">
    <div class="beatmap-discussion beatmap-discussion--single beatmapset-activities__post-grow">
        <div class="beatmap-discussion-timestamp__icons-container">
            <div class="beatmap-discussion-timestamp__icons">
                <a href="{{ route('beatmapsets.discussion', $post->beatmapDiscussion->beatmapset) }}#/{{ $post->beatmapDiscussion->getKey() }}">
                    <img class='beatmapset-cover'
                        src="{{$post->beatmapDiscussion->beatmapset->coverURL('list')}}"
                        srcSet="{{$post->beatmapDiscussion->beatmapset->coverURL('list')}} 1x, {{$post->beatmapDiscussion->beatmapset->coverURL('list@2x')}} 2x">
                </a>
                <div class="beatmap-discussion-timestamp__icon beatmapset-activities__timeline-icon-margin">
                    <span class="beatmap-discussion-message-type">
                        <span class="fas fa-reply"></span>
                    </span>
                </div>
            </div>
        </div>
        <div class="beatmap-discussion__discussion">
            <div class="beatmap-discussion__top">
                <div class="beatmap-discussion-post beatmap-discussion-post--discussion">
                    <div class="beatmap-discussion-post__content">
                        @include('beatmapset_activities._user', ['user' => $post->user])

                        <div class="beatmap-discussion-post__message-container">
                            <div class="beatmap-discussion-post__message">{{$post->message}}</div>
                            <div class="beatmap-discussion-post__info-container">
                                <span class="beatmap-discussion-post__info">{!! timeago($post->created_at) !!}</span>
                                @if ($post->deleted_at !== null)
                                    <span class="beatmap-discussion-post__info">
                                        {{ trans('beatmap_discussions.item.deleted_at') }}: {!! timeago($post->deleted_at) !!}
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
