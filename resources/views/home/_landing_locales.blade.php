{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="landing-nav__locale-menu-link">
    <span class="landing-nav__link js-menu" data-menu-target="landing--locale">
        <span class="landing-nav__locale-flag">
            @include('objects._flag_country', [
                'countryCode' => $currentLocaleMeta->flag(),
            ])
        </span>

        {{ $currentLocaleMeta->name() }}
    </span>

    <div
        class="js-menu landing-nav__locale-menu"
        data-menu-id="landing--locale"
        data-visibility="hidden"
    >
        @foreach (config('app.available_locales') as $locale)
            @php
                $localeMeta = locale_meta($locale);
            @endphp
            <button
                type="button"
                class="landing-nav__locale-button"
                @if ($localeMeta !== $currentLocaleMeta)
                    data-url="{{ route('set-locale', ['locale' => $locale]) }}"
                    data-remote="1"
                    data-method="POST"
                @endif
            >
                <span class="landing-nav__link landing-nav__link--locale">
                    <span class="landing-nav__locale-link-pointer">
                        <span class="fas fa-chevron-right"></span>
                    </span>

                    <span class="landing-nav__locale-flag">
                        @include('objects._flag_country', [
                            'countryCode' => $localeMeta->flag(),
                        ])
                    </span>

                    {{ $localeMeta->name() }}
                </span>
            </button>
        @endforeach
    </div>
</div>
