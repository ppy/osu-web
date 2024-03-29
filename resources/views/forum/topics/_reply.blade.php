{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    if (priv_check('ForumTopicReply', $topic)->can()) {
        if (!$topic->isActive()) {
            if (priv_check('ForumTopicStore', $topic->forum)->can()) {
                $warning = osu_trans('forum.topic.create.necropost.new_topic._', [
                    'create' => link_to(
                        route('forum.topics.create', ['forum_id' => $topic->forum_id]),
                        osu_trans('forum.topic.create.necropost.new_topic.create'),
                    ),
                ]);
            } else {
                $warning = e(osu_trans('forum.topic.create.necropost.default'));
            }
        }
    } else {
        $warning = e(priv_check('ForumTopicReply', $topic)->message());
    }
@endphp
<div class="js-forum-topic-reply--container js-sync-height--target forum-topic-reply" data-sync-height-id="forum-topic-reply">
    <form
        action="{{ route('forum.topics.reply', $topic->getKey()) }}"
        class="osu-page osu-page--forum-topic-reply js-forum-post-input--form js-forum-topic-reply js-sync-height--reference js-fixed-element"
        data-force-reload="{{ Auth::check() ? '0' : '1' }}"
        data-remote
        data-sync-height-target="forum-topic-reply"
        method="POST"
    >
        @csrf
        @if (isset($warning))
            <div class="warning-box">
                <div class="warning-box__icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>

                <div class="warning-box__content">
                    {!! $warning !!}
                </div>
            </div>
        @endif

        @include('forum.topics._post_edit_form', [
            'enabled' => priv_check('ForumTopicReply', $topic)->can(),
            'inputId' => "topic:{$topic->getKey()}",
            'type' => 'reply',
        ])
    </form>
</div>
