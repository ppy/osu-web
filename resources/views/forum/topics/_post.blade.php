{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<?php
    $options['postPosition'] ??= 1;

    $user = $post->userNormalized();
    $blocked = $currentUser !== null && $currentUser->hasBlocked($user);
    $hidden = $blocked || $post->trashed() || ($options['postPosition'] === 1 && $post->topic->trashed());
?>
<div
    {{-- js-forum-post is also used by js-forum-post-report for the postId and postUsername dataset --}}
    class="js-forum-post {{ $hidden ? 'js-forum-post--hidden' : '' }} forum-post"
    data-post-id="{{ $post->getKey() }}"
    data-post-username="{{ $user->username }}"
    data-post-position="{{ $options["postPosition"] }}"
>
    @if ($blocked)
        <div class="forum-post-info">
            {!! link_to_user($user, null, null, ['forum-post-info__row', 'forum-post-info__row--username']) !!}
        </div>
        <div class="forum-post__body">
            <div class="forum-post__content forum-post__content--blocked">
                {!! osu_trans('users.blocks.forum_post_text') !!}
            </div>
        </div>
    @else
        @php
        $options['signature'] ??= true;

        $options['buttons']['delete'] ??= false;
        $options['buttons']['edit'] ??= false;
        $options['buttons']['quote'] ??= false;
        $options['buttons']['report'] = $currentUserId !== null && $post->poster_id !== $currentUserId;

        $buttons = [];

        foreach (['edit', 'delete', 'quote', 'report'] as $buttonType) {
            if ($options['buttons'][$buttonType]) {
                $buttons[] = $buttonType;
            }
        }
        @endphp
        @include('forum.topics._post_info', compact('user'))

        <div class="forum-post__body js-forum-post-edit--container">
            <div class="forum-post__content forum-post__content--header">
                <div class="forum-post__header-content">
                    @if (isset($topic) && $topic->topic_poster === $post->poster_id)
                        <div class="forum-post__header-content-item">
                            <span class="forum-user-badge">
                                {{ osu_trans('forum.post.info.topic_starter') }}
                            </span>
                        </div>
                    @endif

                    <div class="forum-post__header-content-item">
                        {!! link_to_user($user, null, '', ['forum-post__user']) !!}

                        <a class="js-post-url" rel="nofollow" href="{{ $post->exists ? route('forum.posts.show', $post->post_id) : '#' }}">
                            {!! timeago($post->post_time) !!}
                        </a>
                    </div>

                    @if ($post->legacyIcon() !== null)
                        <div class="forum-post__header-content-item">
                            @include('forum._legacy_icon', ['icon' => $post->legacyIcon()])
                        </div>
                    @endif
                </div>

                @if (count($buttons) > 0)
                    <div class="forum-post__menu">
                        @php
                            $menuId = implode(':', ['forum-post', $post->getKey(), rand()]);
                        @endphp
                        <button class="forum-post__menu-button js-click-menu" data-click-menu-target="{{ $menuId }}">
                            <span class="fas fa-ellipsis-v"></span>
                        </button>

                        <div
                            class="simple-menu simple-menu--forum-list js-click-menu"
                            data-visibility="hidden"
                            data-click-menu-id="{{ $menuId }}"
                        >
                            @foreach ($buttons as $button)
                                @include("forum.posts._button_{$button}", [
                                    'class' => 'simple-menu__item',
                                    'post' => $post,
                                    'type' => 'menu',
                                ])
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="forum-post__content forum-post__content--main">
                <div class="forum-post-content {{ $options['contentExtraClasses'] ?? '' }} js-audio--group">
                    {!! $post->bodyHTML() !!}
                </div>
            </div>

            @if($post->post_edit_count > 0)
                <div class="forum-post__content forum-post__content--footer">
                    {!!
                        osu_trans_choice('forum.post.edited', $post->post_edit_count, [
                            'user' => link_to_user($post->lastEditorNormalized(), null, '', []),
                            'when' => timeago($post->post_edit_time),
                        ])
                    !!}
                </div>
            @endif

            @if($options["signature"] !== false && null !== ($signature = $userSignatures->get($user)))
                <div class="forum-post__content forum-post__content--signature js-audio--group hidden-xs">
                    {!! $signature !!}
                </div>
            @endif

            @if (count($buttons) > 0)
                <div class="forum-post__actions">
                    @foreach ($buttons as $button)
                        @include("forum.posts._button_{$button}", ['post' => $post, 'type' => 'circle'])
                    @endforeach
                </div>
            @endif
        </div>
    @endif
</div>
