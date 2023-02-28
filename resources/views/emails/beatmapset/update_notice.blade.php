{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
{!! osu_trans('mail.common.hello', ['user' => $user->username]) !!}

{!! osu_trans('mail.beatmapset_update_notice.new', ['title' => $beatmapset->title]) !!}

{!! osu_trans('mail.beatmapset_update_notice.visit') !!}
{!! route('beatmapsets.discussion', $beatmapset) !!}

{!! osu_trans('mail.beatmapset_update_notice.unwatch') !!}
{!! route('follows.index', ['subtype' => 'modding']) !!}

@include('emails._signature')
