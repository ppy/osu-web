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
    $total = $newTopic ? 1 : $topic->postsCount();
@endphp
<div class="counter-box counter-box--info">
    <div class="counter-box__title">
        {{ trans('forum.topics.show.total_posts') }}
    </div>

    <div data-total="{{ $total }}" class="counter-box__count js-forum__total-count">
        {{ i18n_number_format($total) }}
    </div>
</div>
