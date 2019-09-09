{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.

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
    if (priv_check('ForumTopicReply', $topic)->can()) {
        if (!$topic->isActive()) {
            if (priv_check('ForumTopicStore', $topic->forum)->can()) {
                $warning = trans('forum.topic.create.necropost.new_topic._', [
                    'create' => link_to_route(
                        'forum.topics.create',
                        trans('forum.topic.create.necropost.new_topic.create'),
                        ['forum_id' => $topic->forum],
                        ['class' => 'link link--default']
                    ),
                ]);
            } else {
                $warning = e(trans('forum.topic.create.necropost.default'));
            }
        }
    } else {
        $warning = e(priv_check('ForumTopicReply', $topic)->message());
    }
@endphp
<div class="js-forum-topic-reply--container js-sync-height--target forum-topic-reply" data-sync-height-id="forum-topic-reply">
    {!! Form::open([
        'url' => route('forum.topics.reply', $topic->getKey()),
        'class' => 'osu-page osu-page--forum-topic-reply js-forum-topic-reply js-sync-height--reference js-fixed-element',
        'data-remote' => true,
        'data-sync-height-target' => 'forum-topic-reply',
        'data-force-reload' => Auth::check() ? '0' : '1',
    ]) !!}
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

        @include('forum.topics._post_edit_form', ['type' => 'reply', 'enabled' => priv_check('ForumTopicReply', $topic)->can()])
    {!! Form::close() !!}
</div>
