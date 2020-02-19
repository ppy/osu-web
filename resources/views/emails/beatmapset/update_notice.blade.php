{!! trans('mail.common.hello', ['user' => $user->username]) !!}

{!! trans('mail.beatmapset_update_notice.new', ['title' => $beatmapset->title]) !!}

{!! trans('mail.beatmapset_update_notice.visit') !!}
{!! route('beatmapsets.discussion', $beatmapset) !!}

{!! trans('mail.beatmapset_update_notice.unwatch') !!}
{!! route('beatmapsets.watches.index') !!}

@include('emails._signature')
