{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    // input field name mappings for view recycling.
    // pass in $fields to set; set a field to null to remove it.
    // TODO: hopefully this can be temporary ಠ_ಠ.
    $fieldDefaults = [
        'forumId' => 'forum_id',
        'includeDeleted' => 'include_deleted',
        'includeSubforums' => 'forum_children',
        'sort' => 'sort',
        'topicId' => 'topic_id',
        'user' => 'username',
    ];

    $params = request()->all();

    if (isset($fields)) {
        $fields = array_merge($fieldDefaults, $fields);
    } else {
        $fields = $fieldDefaults;
    }
@endphp

<div id="search-forum-options" class="search-forum-options">
    @if ($fields['user'] !== null)
        <label class="input-container">
            <div class="input-container__label">
                {{ osu_trans('home.search.forum_post.label.username') }}
            </div>

            <input
                name="{{ $fields['user'] }}"
                value="{{ $params[$fields['user']] ?? null }}"
                class="input-text"
            >
        </label>
    @endif

    @if ($fields['sort'] !== null && present($params[$fields['sort']] ?? null))
        <input type="hidden" name="{{ $fields['sort'] }}" value="{{ $params[$fields['sort']] }}" />
    @endif

    {{-- FIXME: remove querystring check? --}}
    @if ($fields['topicId'] !== null && present($params[$fields['topicId']] ?? null))
        <label class="input-container">
            <div class="input-container__label">
                {{ osu_trans('home.search.forum_post.label.topic_id') }}
            </div>

            <input
                name="{{ $fields['topicId'] }}"
                value="{{ $params[$fields['topicId']] }}"
                class="input-text"
            >
        </label>
    @elseif ($fields['forumId'] !== null)
        <label class="input-container input-container--select">
            <div class="input-container__label">
                {{ osu_trans('home.search.forum_post.label.forum') }}
            </div>

            <select
                name="{{ $fields['forumId'] }}"
                class="input-text"
            >
                <option value="">
                    {{ osu_trans('home.search.forum_post.all') }}
                </option>

                @foreach (App\Models\Forum\Forum::searchable()->displayList()->get() as $forum)
                    @if (priv_check('ForumView', $forum)->can())
                        @php
                            $currentDepth = $forum->currentDepth();
                        @endphp
                        @if ($currentDepth === 0)
                            <hr>
                        @endif
                        <option
                            value="{{ $forum->getKey() }}"
                            {{ $forum->getKey() === get_int($params[$fields['forumId']] ?? null) ? 'selected' : '' }}
                        >
                            {{ str_repeat('–', $currentDepth) }}
                            {{ $forum->forum_name }}
                        </option>
                    @endif
                @endforeach
            </select>
        </label>

        <label class="search-forum-options__checkbox">
            @include('objects._switch', ['locals' => [
                'checked' => $params[$fields['includeSubforums']] ?? null,
                'name' => $fields['includeSubforums'],
            ]])

            {{ osu_trans('home.search.forum_post.label.forum_children') }}
        </label>
    @endif

    @if ($fields['includeDeleted'] !== null)
        <label class="search-forum-options__checkbox">
            @include('objects._switch', ['locals' => [
                'checked' => $params[$fields['includeDeleted']] ?? null,
                'name' => $fields['includeDeleted'],
            ]])

            {{ osu_trans('home.search.forum_post.label.include_deleted') }}
        </label>
    @endif

    <div class="search-forum-options__buttons">
        <button class="btn-osu-big btn-osu-big--rounded-thin">
            <div class="btn-osu-big__content">
                <div class="btn-osu-big__left">
                    {{ osu_trans('home.search.button') }}
                </div>

                <div class="btn-osu-big__icon">
                    <span class="fas fa-search"></span>
                </div>
            </div>
        </button>

        <button type="button" class="btn-osu-big btn-osu-big--rounded-thin js-search--forum-options-reset">
            <div class="btn-osu-big__content">
                <div class="btn-osu-big__left">
                    {{ osu_trans('common.buttons.reset') }}
                </div>

                <div class="btn-osu-big__icon">
                    <span class="fas fa-sync"></span>
                </div>
            </div>
        </button>
    </div>
</div>
