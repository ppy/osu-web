{{--
    Copyright 2015-2017 ppy Pty. Ltd.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License version 3
    as published by the Free Software Foundation.i
    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}
<a
    class="
        changelog-stream
        {{ $featured ? 'changelog-stream--featured' : '' }}
        {{ isset($build) && $build->version === $stream->version ? 'changelog-stream--active' : '' }}
        changelog-stream--{{ str_slug($stream->updateStream->pretty_name) }}
    "
    href={{ route('changelog', ['build' => $stream->version]) }}
  >
    <div class="changelog-stream__content">
        <span class="changelog-stream__name u-ellipsis-overflow">{{ $stream->updateStream->pretty_name }}</span>
        <span class="changelog-stream__build u-ellipsis-overflow">{{ $stream->displayVersion() }}</span>
        <span class="changelog-stream__users">{{ trans_choice('changelog.users-online', $stream->users, ['users' => $stream->users]) }}</span>
    </div>
    <div class="changelog-stream__indicator"></div>
</a>
