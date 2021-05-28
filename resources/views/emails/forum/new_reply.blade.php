{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
{!! trans('mail.common.hello', ['user' => $user->username]) !!}

{!! trans('mail.forum_new_reply.new', ['title' => $topic->topic_title]) !!}

{!! trans('mail.forum_new_reply.visit') !!}
{!! post_url($topic->topic_id, 'unread', false) !!}

{!! trans('mail.forum_new_reply.unwatch') !!}
{!! route('follows.index', ['subtype' => 'forum_topic']) !!}

@include('emails._signature')
