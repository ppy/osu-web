{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<a href="#" id="nav-button">
    <span>
        MENU
        <i class="menu-burger"></i>
    </span>
</a>
<div class="tocify-wrapper">
    <div class="logo"></div>

    @isset($metadata['example_languages'])
        <div class="lang-selector">
            @foreach($metadata['example_languages'] as $name => $lang)
                @php if (is_numeric($name)) $name = $lang; @endphp
                <button type="button" class="lang-button js-set-language" data-language-name="{{ $lang }}">{{ $name }}</button>
            @endforeach
        </div>
    @endisset

    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
    </div>

    <ul class="toc-footer" id="toc-footer">
        <li style="padding-bottom: 5px;">
            <a href="https://github.com/ppy/osu-web">
                osu-web on GitHub
            </a>
        </li>
        <li style="padding-bottom: 5px;">
            <a href="https://osu.ppy.sh">
                osu!
            </a>
        </li>
        @if($metadata['postman_collection_url'])
            <li style="padding-bottom: 5px;"><a href="{!! $metadata['postman_collection_url'] !!}">View Postman collection</a></li>
        @endif
        @if($metadata['openapi_spec_url'])
            <li style="padding-bottom: 5px;"><a href="{!! $metadata['openapi_spec_url'] !!}">View OpenAPI spec</a></li>
        @endif
        <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>{{ $metadata['last_updated'] }}</li>
    </ul>
</div>
