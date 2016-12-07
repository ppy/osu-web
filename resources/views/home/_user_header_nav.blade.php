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
<ul class="page-mode">
    <li class="page-mode__item">
        <a
            href="{{ route('account.edit') }}"
            class="
                page-mode-link
                {{ $current_action === 'account-edit' ? 'page-mode-link--is-active' : '' }}
            "
        >
            {{ trans('accounts.edit.title_compact') }}

            <span class="page-mode-link__stripe"></span>
        </a>
    </li>

    <li class="page-mode__item">
        <a
            href="{{ route('forum.topic-watches.index') }}"
            class="
                page-mode-link
                {{ $current_action === 'forum-topic-watches-index' ? 'page-mode-link--is-active' : '' }}
            "
        >
            {{ trans('forum.topic_watches.index.title_compact') }}

            <span class="page-mode-link__stripe"></span>
        </a>
    </li>
</ul>
