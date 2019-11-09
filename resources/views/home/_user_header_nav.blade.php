{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<ul class="page-mode">
    <li class="page-mode__item">
        <a
            href="{{ route('home') }}"
            class="
                page-mode-link
                {{ $currentAction === 'index' ? 'page-mode-link--is-active' : '' }}
            "
        >
            {{ trans('home.user.title') }}

            <span class="page-mode-link__stripe"></span>
        </a>
    </li>

    <li class="page-mode__item">
        <a
            href="{{ route('friends.index') }}"
            class="
                page-mode-link
                {{ $currentAction === 'friends-index' ? 'page-mode-link--is-active' : '' }}
            "
        >
            {{ trans('friends.title_compact') }}

            <span class="page-mode-link__stripe"></span>
        </a>
    </li>

    <li class="page-mode__item">
        <a
            href="{{ route('forum.topic-watches.index') }}"
            class="
                page-mode-link
                {{ $currentAction === 'forum-topic-watches-index' ? 'page-mode-link--is-active' : '' }}
            "
        >
            {{ trans('forum.topic_watches.index.title_compact') }}

            <span class="page-mode-link__stripe"></span>
        </a>
    </li>

    <li class="page-mode__item">
        <a
            href="{{ route('beatmapsets.watches.index') }}"
            class="
                page-mode-link
                {{ $currentAction === 'beatmapset-watches-index' ? 'page-mode-link--is-active' : '' }}
            "
        >
            {{ trans('beatmapset_watches.index.title_compact') }}

            <span class="page-mode-link__stripe"></span>
        </a>
    </li>

    <li class="page-mode__item">
        <a
            href="{{ route('account.edit') }}"
            class="
                page-mode-link
                {{ $currentAction === 'account-edit' ? 'page-mode-link--is-active' : '' }}
            "
        >
            {{ trans('accounts.edit.title_compact') }}

            <span class="page-mode-link__stripe"></span>
        </a>
    </li>
</ul>
