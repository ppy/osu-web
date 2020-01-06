{!! trans('mail.common.hello', ['user' => $user->username]) !!}

{!! trans('mail.forum_new_reply.new', ['title' => $topic->topic_title]) !!}

{!! trans('mail.forum_new_reply.visit') !!}
{!! post_url($topic->topic_id, 'unread', false) !!}

{!! trans('mail.forum_new_reply.unwatch') !!}
{!! route('forum.topic-watches.index') !!}

@include('emails._signature')
