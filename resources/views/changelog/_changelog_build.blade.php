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
        changelog-build
        {{ $featured ? 'changelog-build--featured' : '' }}
        {{ isset($activeBuild) && $activeBuild->version === $build->version ? 'changelog-build--active' : '' }}
        changelog-build--{{ str_slug($build->updateStream->pretty_name) }}
    "
    href={{ route('changelog.show', ['build' => $build->version]) }}
  >
    <div class="changelog-build__content">
        <span class="changelog-build__name u-ellipsis-overflow">{{ $build->updateStream->pretty_name }}</span>
        <span class="changelog-build__build u-ellipsis-overflow">{{ $build->displayVersion() }}</span>
        <span class="changelog-build__users">{{ trans_choice('changelog.users-online', $build->users, ['users' => $build->users]) }}</span>
    </div>
    <div class="changelog-build__indicator"></div>
</a>
