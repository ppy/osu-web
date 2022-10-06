{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<button
    class="nav-button nav-button--stadium js-click-menu"
    data-click-menu-target="nav2-locale-popup"
>
    <span class="nav-button__locale-current-flag">
        @include('objects._flag_country', [
            'countryCode' => $currentLocaleMeta->flag(),
            'modifiers' => ['flat'],
        ])
    </span>
</button>

<div class="nav-click-popup">
    <div
        class="simple-menu simple-menu--nav2 simple-menu--nav2-locales js-click-menu js-nav2--centered-popup"
        data-click-menu-id="nav2-locale-popup"
        data-visibility="hidden"
    >
        <div class="simple-menu__content">
            @foreach (config('app.available_locales') as $locale)
                @php
                    $localeMeta = locale_meta($locale);
                @endphp
                <button
                    type="button"
                    class="
                        simple-menu__item
                        {{ $localeMeta === $currentLocaleMeta ? 'simple-menu__item--active' : '' }}
                    "
                    @if ($localeMeta !== $currentLocaleMeta)
                        data-url="{{ route('set-locale', ['locale' => $locale]) }}"
                        data-remote="1"
                        data-method="POST"
                    @endif
                >
                    <span class="nav2-locale-item">
                        <span class="nav2-locale-item__flag">
                            @include('objects._flag_country', [
                                'countryCode' => $localeMeta->flag(),
                                'modifiers' => ['flat'],
                            ])
                        </span>

                        {{ $localeMeta->name() }}
                    </span>
                </button>
            @endforeach
        </div>
    </div>
</div>
