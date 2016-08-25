Hi {{ $user->username }},

Just letting you know that there has been a new reply in "{{ $topic->topic_title }}" since your last visit.

Jump straight to the latest reply using the following link:
{{ post_url($topic->topic_id, 'unread', false) }}

If you no longer wish to watch this topic, you can either click the "Unsubscribe topic" link found at the bottom of the topic above, or by clicking the following link:
<unsubscribe link goes here>

@include('emails._signature')
