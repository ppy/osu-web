{{--
    Copyright 2015-2016 ppy Pty. Ltd.

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
<a
    class="forum-topic-nav__button-circle"
    href="{{ route('forum.topics.lock', [
        $_topic,
        'lock' => ($_topic->isLocked() === true ? '0' : null),
    ]) }}"
    data-remote="1"
    data-method="post"
    data-reload-on-success="1"
    data-reload-reset-scroll="1"
>
    @if ($_topic->isLocked())
        <i class="fa fa-unlock"></i>
    @else
        <i class="fa fa-lock"></i>
    @endif
</a>
