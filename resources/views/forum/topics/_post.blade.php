{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<?php
    $options['postPosition'] = $options['postPosition'] ?? 1;
    $options['signature'] = $options['signature'] ?? true;

    $options['buttons']['delete'] = $options['buttons']['delete'] ?? false;
    $options['buttons']['edit'] = $options['buttons']['edit'] ?? false;
    $options['buttons']['quote'] = $options['buttons']['quote'] ?? false;
    $options['buttons']['report'] = auth()->check() && $post->poster_id !== auth()->user()->getKey();

    $buttons = [];

    foreach (['edit', 'delete', 'quote', 'report'] as $buttonType) {
        if ($options['buttons'][$buttonType]) {
            $buttons[] = $buttonType;
        }
    }

    $user = $post->userNormalized();
    $hidden = $post->trashed() || ($options['postPosition'] === 1 && $post->topic->trashed());
?>
<div
    {{-- js-forum-post is also used by js-forum-post-report for the postId and postUsername dataset --}}
    class="js-forum-post {{ $hidden ? 'js-forum-post--hidden' : '' }} forum-post"
    data-post-id="{{ $post->getKey() }}"
    data-post-username="{{ $user->username }}"
    data-post-position="{{ $options["postPosition"] }}"
>
    @include('forum.topics._post_info', compact('user'))

    <div class="forum-post__body js-forum-post-edit--container">
        <div class="forum-post__content forum-post__content--header">
            <div class="forum-post__header-content">
                @if (isset($topic) && $topic->topic_poster === $post->poster_id)
                    <div class="forum-post__header-content-item">
                        <span class="forum-user-badge">
                            {{ trans('forum.post.info.topic_starter') }}
                        </span>
                    </div>
                @endif

                <div class="forum-post__header-content-item">
                    {!! link_to_user($user, null, '', ['forum-post__user']) !!}

                    <a class="js-post-url" rel="nofollow" href="{{ $post->exists ? route('forum.posts.show', $post->post_id) : '#' }}">
                        {!! timeago($post->post_time) !!}
                    </a>
                </div>
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
                    trans_choice('forum.post.edited', $post->post_edit_count, [
                        'user' => link_to_user($post->lastEditorNormalized(), null, '', []),
                        'when' => timeago($post->post_edit_time),
                    ])
                !!}
            </div>
        @endif

        @if($options["signature"] !== false && present($post->userNormalized()->user_sig))
            <div class="forum-post__content forum-post__content--signature js-audio--group hidden-xs">
                {!! bbcode($post->userNormalized()->user_sig, $post->userNormalized()->user_sig_bbcode_uid) !!}
            </div>
        @endif

        @if (count($buttons) > 0)
            <div class="forum-post__actions">
                <div class="forum-post-actions">
                    @foreach ($buttons as $button)
                        <div class="forum-post-actions__action">
                            @include("forum.posts._button_{$button}", ['post' => $post, 'type' => 'circle'])
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
