Hi {!! $user->username !!},

Just letting you know that there has been a new update in beatmap "{!! $beatmapset->title !!}" since your last visit.

Visit the discussion page here:
{!! route('beatmapsets.discussion', $beatmapset) !!}

If you no longer wish to watch this beatmap, you can either click the "Unwatch" link found in the page above, or from the modding watchlist page:
{!! route('beatmapsets.watches.index') !!}

@include('emails._signature')
